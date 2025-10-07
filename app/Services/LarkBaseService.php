<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LarkBaseService
{
    private $client;
    private $appId;
    private $appSecret;
    private $baseUrl;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'http_errors' => false,
        ]);

        $this->appId = config('services.lark.app_id');
        $this->appSecret = config('services.lark.app_secret');
        $this->baseUrl = 'https://open.larksuite.com/open-apis';

        if (!$this->appId || !$this->appSecret) {
            throw new \Exception('Lark App ID atau App Secret belum dikonfigurasi');
        }
    }

    /**
     * Mendapatkan Tenant Access Token
     */
    private function getAccessToken()
    {
        return Cache::remember('lark_access_token', 7200, function () {
            try {
                Log::info('Getting Lark access token');

                $response = $this->client->post($this->baseUrl . '/auth/v3/tenant_access_token/internal', [
                    'json' => [
                        'app_id' => $this->appId,
                        'app_secret' => $this->appSecret,
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json; charset=utf-8'
                    ]
                ]);

                $statusCode = $response->getStatusCode();
                $body = $response->getBody()->getContents();
                $data = json_decode($body, true);

                if ($statusCode !== 200) {
                    throw new \Exception('HTTP Error ' . $statusCode . ': ' . $body);
                }

                if (isset($data['code']) && $data['code'] !== 0) {
                    throw new \Exception('Lark API Error: ' . ($data['msg'] ?? 'Unknown error'));
                }

                if (!isset($data['tenant_access_token'])) {
                    throw new \Exception('Token tidak ditemukan dalam response: ' . json_encode($data));
                }

                Log::info('Access token obtained successfully');
                return $data['tenant_access_token'];
            } catch (\Exception $e) {
                Log::error('Error getting access token: ' . $e->getMessage());
                throw $e;
            }
        });
    }

    /**
     * Perform HTTP request with automatic token-refresh retry when Lark returns invalid-token code (99991663).
     * Returns array with keys: status_code, body, data
     */
    private function performRequestWithTokenRetry($method, $url, $queryParams = [], $jsonBody = null)
    {
        $attempt = 0;
        $maxAttempts = 2; // first try + one retry after refreshing token

        do {
            $token = $this->getAccessToken();

            $options = [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json; charset=utf-8',
                ],
            ];

            if (!empty($queryParams)) {
                $options['query'] = $queryParams;
            }

            if (!is_null($jsonBody)) {
                $options['json'] = $jsonBody;
            }

            $response = $this->client->request($method, $url, $options);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            // If Lark responds with invalid token code, clear cache and retry once
            if (is_array($data) && isset($data['code']) && $data['code'] === 99991663 && $attempt + 1 < $maxAttempts) {
                Log::warning('Lark returned invalid token code; clearing cached token and retrying', ['url' => $url, 'code' => $data['code']]);
                try {
                    Cache::forget('lark_access_token');
                } catch (\Exception $e) {
                    Log::error('Failed to forget lark_access_token cache: ' . $e->getMessage());
                }

                $attempt++;
                continue;
            }

            return [
                'status_code' => $statusCode,
                'body' => $body,
                'data' => $data,
            ];

        } while ($attempt < $maxAttempts);

        // Fallback: return last response (if any)
        return [
            'status_code' => $statusCode ?? 500,
            'body' => $body ?? null,
            'data' => $data ?? null,
        ];
    }

    /**
     * Mendapatkan semua records dari Base Table
     */
    public function getTableRecords($appToken, $tableId, $pageSize = 100)
    {
        try {
            $token = $this->getAccessToken();
            $allRecords = [];
            $hasMore = true;
            $pageToken = null;
            $pageCount = 0;

            while ($hasMore) {
                $url = $this->baseUrl . '/bitable/v1/apps/' . $appToken . '/tables/' . $tableId . '/records';

                $queryParams = [
                    'page_size' => $pageSize,
                ];

                if ($pageToken) {
                    $queryParams['page_token'] = $pageToken;
                }

                Log::info('Fetching Base records', [
                    'url' => $url,
                    'params' => $queryParams
                ]);

                $resp = $this->performRequestWithTokenRetry('GET', $url, $queryParams, null);
                $statusCode = $resp['status_code'];
                $body = $resp['body'];
                $data = $resp['data'];

                Log::info('Base records response', [
                    'status_code' => $statusCode,
                    'has_data' => isset($data['data'])
                ]);

                if ($statusCode !== 200) {
                    throw new \Exception('HTTP Error ' . $statusCode . ': ' . $body);
                }

                if (isset($data['code']) && $data['code'] !== 0) {
                    $errorMsg = $data['msg'] ?? 'Unknown error';

                    // Handle specific errors
                    if ($data['code'] == 99991663) {
                        throw new \Exception('Base/Table tidak ditemukan atau aplikasi tidak memiliki akses. Pastikan Base sudah di-share ke aplikasi Anda.');
                    }

                    throw new \Exception('Lark API Error (code: ' . $data['code'] . '): ' . $errorMsg);
                }

                // Ambil records
                if (isset($data['data']['items']) && is_array($data['data']['items'])) {
                    // $allRecords = array_merge($allRecords, $data['data']['items']);
                    $recordsInPage = count($data['data']['items']);
                    $allRecords = array_merge($allRecords, $data['data']['items']);
                    Log::info("Page " . ($pageCount + 1) . " fetched: " . $recordsInPage . " records");
                }

                // Cek apakah ada page berikutnya
                $hasMore = $data['data']['has_more'] ?? false;
                $pageToken = $data['data']['page_token'] ?? null;
                $pageCount++;

                // Safety limit - jangan fetch lebih dari 100 pages
                if ($pageCount >= 100) {
                    Log::warning('Reached maximum page limit (100 pages)');
                    break;
                }
                
                // Kasih jeda antar request untuk menghindari rate limit
                if ($hasMore) {
                    usleep(500000); // Sleep 0.5 detik
                }
            }

            Log::info('Total records fetched: ' . count($allRecords));

            return $allRecords;
        } catch (\Exception $e) {
            Log::error('Error getting Base records: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Mendapatkan single record berdasarkan record_id
     */
    public function getRecord($appToken, $tableId, $recordId)
    {
        try {
            $token = $this->getAccessToken();
            
            $url = $this->baseUrl . '/bitable/v1/apps/' . $appToken . '/tables/' . $tableId . '/records/' . $recordId;
            
            Log::info('Fetching single record', [
                'url' => $url,
                'record_id' => $recordId
            ]);

            $response = $this->client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json; charset=utf-8',
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
            
            if ($statusCode !== 200) {
                throw new \Exception('HTTP Error ' . $statusCode . ': ' . $body);
            }
            
            if (isset($data['code']) && $data['code'] !== 0) {
                throw new \Exception('Lark API Error: ' . ($data['msg'] ?? 'Unknown error'));
            }
            
            return $data['data']['record'] ?? null;
            
        } catch (\Exception $e) {
            Log::error('Error getting single record: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update record di Lark Base
     * 
     * @param string $appToken - Base token
     * @param string $tableId - Table ID
     * @param string $recordId - Record ID yang akan diupdate
     * @param array $fields - Array fields yang akan diupdate
     * @return array Response dari API
     */
    public function updateRecord($appToken, $tableId, $recordId, $fields)
    {
        try {
            // Prepare update payload by converting simple input values into the same
            // structure as existing record fields so Lark API accepts them.
            $url = $this->baseUrl . '/bitable/v1/apps/' . $appToken . '/tables/' . $tableId . '/records/' . $recordId;

            Log::info('Preparing update for record', [
                'url' => $url,
                'record_id' => $recordId,
                'fields' => $fields
            ]);

            // Fetch existing record to infer field shapes
            $existingRecord = $this->getRecord($appToken, $tableId, $recordId);
            $existingFields = $existingRecord['fields'] ?? [];

            // Fetch table field metadata (for single-select options lookup)
            $tableFieldsMeta = $this->getTableFields($appToken, $tableId);
            $metaByName = [];
            foreach ($tableFieldsMeta as $meta) {
                if (isset($meta['name'])) {
                    $metaByName[$meta['name']] = $meta;
                }
            }

            $payloadFields = [];

            foreach ($fields as $fieldName => $value) {
                $existingValue = $existingFields[$fieldName] ?? null;

                // If existing field is an array (complex types), attempt to convert
                if (is_array($existingValue) && isset($existingValue[0]) && is_array($existingValue[0])) {
                    // Handle single-select / multi-select / user-like fields
                    $first = $existingValue[0];

                    // Try to detect option id key in existing entry
                    $optionIdKey = null;
                    foreach (['option_id', 'id', 'value_id'] as $k) {
                        if (array_key_exists($k, $first)) {
                            $optionIdKey = $k;
                            break;
                        }
                    }

                    // Try to detect text key in existing entry
                    $textKey = null;
                    foreach (['text', 'name', 'value', 'label'] as $k) {
                        if (array_key_exists($k, $first)) {
                            $textKey = $k;
                            break;
                        }
                    }

                    // If existing entries contain option id, attempt to find matching option id from metadata
                    if ($optionIdKey) {
                        $matchedOptionId = null;
                        // Look up options in table metadata
                        $meta = $metaByName[$fieldName] ?? null;
                        if ($meta && isset($meta['options']) && is_array($meta['options'])) {
                            foreach ($meta['options'] as $opt) {
                                // option text might be under 'text' or 'name' or 'label'
                                $optText = $opt['text'] ?? $opt['name'] ?? $opt['label'] ?? null;
                                $optId = $opt['option_id'] ?? $opt['id'] ?? $opt['value_id'] ?? null;
                                if ($optText !== null && $optId !== null && (string)$optText === (string)$value) {
                                    $matchedOptionId = $optId;
                                    break;
                                }
                            }
                        }

                        if ($matchedOptionId === null) {
                            // Cannot convert provided display text to option id
                            throw new \Exception('SingleSelectFieldConvFail: gagal menemukan option_id untuk field "' . $fieldName . '" dengan nilai "' . $value . '"');
                        }

                        // Construct payload entry similar to existing structure but with matched option id
                        $payloadFields[$fieldName] = [[ $optionIdKey => $matchedOptionId ]];
                        continue;
                    }

                    // If existing entries are text-based, create array with text key
                    if ($textKey) {
                        $payloadFields[$fieldName] = [[ $textKey => $value ]];
                        continue;
                    }

                    // Fallback: if it's array-shaped but we couldn't detect keys, try to send as JSON string
                    $payloadFields[$fieldName] = $value;
                    continue;
                }

                // Otherwise send as scalar
                $payloadFields[$fieldName] = $value;
            }

            Log::info('Final payload fields prepared', ['payload' => $payloadFields]);

            $resp = $this->performRequestWithTokenRetry('PUT', $url, [], ['fields' => $payloadFields]);
            $statusCode = $resp['status_code'];
            $body = $resp['body'];
            $data = $resp['data'];
            
            Log::info('Update response', [
                'status_code' => $statusCode,
                'response' => $data
            ]);
            
            if ($statusCode !== 200) {
                throw new \Exception('HTTP Error ' . $statusCode . ': ' . $body);
            }
            
            if (isset($data['code']) && $data['code'] !== 0) {
                $errorMsg = $data['msg'] ?? 'Unknown error';
                throw new \Exception('Gagal update record: ' . $errorMsg);
            }
            
            return $data['data']['record'] ?? [];
            
        } catch (\Exception $e) {
            Log::error('Error updating record: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Batch update multiple records
     */
    public function batchUpdateRecords($appToken, $tableId, $records)
    {
        try {
            $token = $this->getAccessToken();
            
            $url = $this->baseUrl . '/bitable/v1/apps/' . $appToken . '/tables/' . $tableId . '/records/batch_update';
            
            Log::info('Batch updating records', [
                'url' => $url,
                'count' => count($records)
            ]);

            $resp = $this->performRequestWithTokenRetry('POST', $url, [], ['records' => $records]);
            $statusCode = $resp['status_code'];
            $body = $resp['body'];
            $data = $resp['data'];
            
            if ($statusCode !== 200) {
                throw new \Exception('HTTP Error ' . $statusCode . ': ' . $body);
            }
            
            if (isset($data['code']) && $data['code'] !== 0) {
                throw new \Exception('Batch update error: ' . ($data['msg'] ?? 'Unknown error'));
            }
            
            return $data['data']['records'] ?? [];
            
        } catch (\Exception $e) {
            Log::error('Error batch updating records: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Parse records menjadi format yang lebih mudah dibaca
     * Sekarang dengan record_id
     */
    public function parseRecords($records)
    {
        $result = [];
        
        foreach ($records as $record) {
            $fields = $record['fields'] ?? [];
            
            $parsedFields = [
                'record_id' => $record['record_id'] ?? null, // Simpan record_id untuk update
            ];
            
            foreach ($fields as $fieldName => $fieldValue) {
                if (is_array($fieldValue)) {
                    if (isset($fieldValue[0]['text'])) {
                        $parsedFields[$fieldName] = implode(', ', array_column($fieldValue, 'text'));
                    } elseif (isset($fieldValue[0]['name'])) {
                        $parsedFields[$fieldName] = implode(', ', array_column($fieldValue, 'name'));
                    } else {
                        $parsedFields[$fieldName] = json_encode($fieldValue);
                    }
                } else {
                    $parsedFields[$fieldName] = $fieldValue;
                }
            }
            
            $result[] = $parsedFields;
        }
        
        return $result;
    }

    /**
     * Mendapatkan informasi fields/columns dari table
     */
    public function getTableFields($appToken, $tableId)
    {
        try {
            $token = $this->getAccessToken();
            
            $url = $this->baseUrl . '/bitable/v1/apps/' . $appToken . '/tables/' . $tableId . '/fields';
            
            $resp = $this->performRequestWithTokenRetry('GET', $url, [], null);
            $data = $resp['data'];
            
            if (isset($data['code']) && $data['code'] !== 0) {
                throw new \Exception('Error getting fields: ' . ($data['msg'] ?? 'Unknown error'));
            }
            
            return $data['data']['items'] ?? [];
            
        } catch (\Exception $e) {
            Log::error('Error getting table fields: ' . $e->getMessage());
            throw $e;
        }
    }
    /**
     * Parse records menjadi format yang lebih mudah dibaca
     */
    // public function parseRecords($records)
    // {
    //     $result = [];

    //     foreach ($records as $record) {
    //         $fields = $record['fields'] ?? [];

    //         // Konversi fields menjadi array biasa
    //         $parsedFields = [];
    //         foreach ($fields as $fieldName => $fieldValue) {
    //             // Handle different field types
    //             if (is_array($fieldValue)) {
    //                 // Untuk field seperti User, Attachment, dll
    //                 if (isset($fieldValue[0]['text'])) {
    //                     // Multiple select atau similar
    //                     $parsedFields[$fieldName] = implode(', ', array_column($fieldValue, 'text'));
    //                 } elseif (isset($fieldValue[0]['name'])) {
    //                     // User field
    //                     $parsedFields[$fieldName] = implode(', ', array_column($fieldValue, 'name'));
    //                 } else {
    //                     $parsedFields[$fieldName] = json_encode($fieldValue);
    //                 }
    //             } else {
    //                 $parsedFields[$fieldName] = $fieldValue;
    //             }
    //         }

    //         $result[] = $parsedFields;
    //     }

    //     return $result;
    // }

    // /**
    //  * Mendapatkan informasi fields/columns dari table
    //  */
    // public function getTableFields($appToken, $tableId)
    // {
    //     try {
    //         $token = $this->getAccessToken();

    //         $url = $this->baseUrl . '/bitable/v1/apps/' . $appToken . '/tables/' . $tableId . '/fields';

    //         $response = $this->client->get($url, [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $token,
    //                 'Content-Type' => 'application/json; charset=utf-8',
    //             ]
    //         ]);

    //         $data = json_decode($response->getBody()->getContents(), true);

    //         if (isset($data['code']) && $data['code'] !== 0) {
    //             throw new \Exception('Error getting fields: ' . ($data['msg'] ?? 'Unknown error'));
    //         }

    //         return $data['data']['items'] ?? [];
    //     } catch (\Exception $e) {
    //         Log::error('Error getting table fields: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }


}
