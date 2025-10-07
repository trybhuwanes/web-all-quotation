<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LarkSheetService
{
    private $client;
    private $appId;
    private $appSecret;
    private $baseUrl = 'https://open.larksuite.com/open-apis';

    public function __construct()
    {
        $this->client = new Client();
        $this->appId = config('services.lark.app_id');
        $this->appSecret = config('services.lark.app_secret');
    }

    /**
     * Mendapatkan Access Token
     */
    private function getAccessToken()
    {
        // Cache token selama 2 jam (token valid 2 jam)
        return Cache::remember('lark_access_token', 7200, function () {
            $response = $this->client->post($this->baseUrl . '/auth/v3/tenant_access_token/internal', [
                'json' => [
                    'app_id' => $this->appId,
                    'app_secret' => $this->appSecret,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            if (!isset($data['tenant_access_token'])) {
                // Log error detail jika ada
                Log::error('Lark API token error', ['response' => $data]);
                throw new \Exception('Gagal mendapatkan tenant_access_token dari Lark. Response: ' . json_encode($data));
            }
            return $data['tenant_access_token'];
        });
    }

    /**
     * Membaca data dari sheet
     */
    public function getSheetData($spreadsheetToken, $range = null)
    {
        $token = $this->getAccessToken();

        // Jika range tidak ditentukan, ambil semua data dari sheet pertama
        if (!$range) {
            $range = 'RAW DATA!A1:Z1000'; // Sesuaikan dengan kebutuhan
        }

        $url = $this->baseUrl . '/sheets/v2/spreadsheets/' . $spreadsheetToken . '/values/' . $range;

        $response = $this->client->get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['data']['valueRange']['values'] ?? [];
    }

    /**
     * Mengkonversi data sheet menjadi array associative
     */
    public function parseSheetData($sheetData)
    {
        if (empty($sheetData)) {
            return [];
        }

        // Baris pertama sebagai header
        $headers = array_shift($sheetData);

        $result = [];
        foreach ($sheetData as $row) {
            $rowData = [];
            foreach ($headers as $index => $header) {
                $rowData[$header] = $row[$index] ?? null;
            }
            $result[] = $rowData;
        }

        return $result;
    }
}
