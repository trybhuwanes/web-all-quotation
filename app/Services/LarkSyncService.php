<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LarkSyncService
{
    private $larkBaseService;

    public function __construct(LarkBaseService $larkBaseService)
    {
        $this->larkBaseService = $larkBaseService;
    }

    /**
     * Sync semua data dari Lark Base ke database
     */
    public function syncAllClients()
    {
        try {
            $baseToken = config('services.lark.base_token');
            $tableId = config('services.lark.table_id');
            
            // Ambil semua records dari Lark
            $rawRecords = $this->larkBaseService->getTableRecords($baseToken, $tableId);
            
            $synced = 0;
            $created = 0;
            $updated = 0;
            $skipped = 0;
            $errors = [];

            foreach ($rawRecords as $record) {
                try {
                    $result = $this->syncSingleRecord($record);
                    
                    if ($result['status'] === 'created') {
                        $created++;
                    } elseif ($result['status'] === 'updated') {
                        $updated++;
                    } elseif ($result['status'] === 'skipped') {
                        $skipped++;
                    }
                    
                    $synced++;
                } catch (\Exception $e) {
                    $errors[] = [
                        'record_id' => $record['record_id'] ?? 'unknown',
                        'error' => $e->getMessage()
                    ];
                    Log::error('Error syncing record: ' . $e->getMessage(), [
                        'record' => $record
                    ]);
                }
            }

            return [
                'success' => true,
                'synced' => $synced,
                'created' => $created,
                'updated' => $updated,
                'skipped' => $skipped,
                'total_records' => count($rawRecords),
                'errors' => $errors
            ];
            
        } catch (\Exception $e) {
            Log::error('Error in syncAllClients: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Sync single record dari Lark ke database
     */
    public function syncSingleRecord($record)
    {
        $fields = $record['fields'] ?? [];
        $recordId = $record['record_id'] ?? null;

        if (!$recordId) {
            return ['status' => 'skipped', 'reason' => 'No record ID'];
        }

        // Validasi field yang wajib (Email dan Contact/Name)
        $email = $this->getFieldValue($fields, 'Email');
        $name = $this->getFieldValue($fields, 'Contact');

        // Skip jika email atau name kosong
        if (empty($name)) {
            return [
                'status' => 'skipped', 
                'reason' => 'Missing required fields (Name)'
            ];
        }

        // Validasi format email
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     return [
        //         'status' => 'skipped', 
        //         'reason' => 'Invalid email format: ' . $email
        //     ];
        // }

        // Cek apakah user sudah ada berdasarkan lark_record_id atau email
        $user = User::where('lark_record_id', $recordId)
                    ->orWhere('email', $email)
                    ->first();

        $userData = [
            'lark_record_id' => $recordId,
            'email' => $email,
            'name' => $name,
            'phone' => $this->getFieldValue($fields, 'Phone number'),
            'job_title' => $this->getFieldValue($fields, 'Job Title'),
            'company' => $this->getFieldValue($fields, 'Company'),
            'location_company' => $this->getFieldValue($fields, 'City, Province (Office)'),
            'field_company' => $this->getFieldValue($fields, 'Industry'),
            'detail_company' => $this->getFieldValue($fields, 'Detail Company (KBLI)'),
            'role' => 'customer',
            'status' => 'active',
        ];

        if ($user) {
            // Update existing user
            // Jangan update password dan email jika sudah ada
            unset($userData['password']);
            
            // Jika user sudah punya email dan berbeda, jangan update
            if ($user->email !== $email) {
                Log::warning('Email conflict', [
                    'existing_email' => $user->email,
                    'new_email' => $email,
                    'record_id' => $recordId
                ]);
                // Gunakan email yang sudah ada
                $userData['email'] = $user->email;
            }
            
            $user->update($userData);
            
            Log::info('User updated from Lark', [
                'user_id' => $user->id,
                'email' => $user->email,
                'record_id' => $recordId
            ]);
            
            return ['status' => 'updated', 'user_id' => $user->id];
        } else {
            // Create new user
            $userData['password'] = Hash::make('clientgrinviro123');
            $userData['email_verified_at'] = now(); // Auto verify email
            
            $user = User::create($userData);
            
            Log::info('User created from Lark', [
                'user_id' => $user->id,
                'email' => $user->email,
                'record_id' => $recordId
            ]);
            
            return ['status' => 'created', 'user_id' => $user->id];
        }
    }

    /**
     * Helper function untuk mengambil field value
     */
    private function getFieldValue($fields, $fieldName)
    {
        $value = $fields[$fieldName] ?? null;
        
        // Handle array values (dari field multi-select, user, dll)
        if (is_array($value)) {
            if (isset($value[0]['text'])) {
                return implode(', ', array_column($value, 'text'));
            } elseif (isset($value[0]['name'])) {
                return implode(', ', array_column($value, 'name'));
            }
            return json_encode($value);
        }
        
        return $value;
    }

    /**
     * Sync user tertentu berdasarkan record_id
     */
    public function syncByRecordId($recordId)
    {
        try {
            $baseToken = config('services.lark.base_token');
            $tableId = config('services.lark.table_id');
            
            $record = $this->larkBaseService->getRecord($baseToken, $tableId, $recordId);
            
            if (!$record) {
                throw new \Exception('Record not found in Lark Base');
            }
            
            return $this->syncSingleRecord($record);
            
        } catch (\Exception $e) {
            Log::error('Error syncing by record ID: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get user by lark record id
     */
    public function getUserByLarkRecordId($recordId)
    {
        return User::where('lark_record_id', $recordId)->first();
    }
}