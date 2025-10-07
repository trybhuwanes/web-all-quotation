<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LarkSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SyncController extends Controller
{
    private $larkSyncService;

    public function __construct(LarkSyncService $larkSyncService)
    {
        $this->larkSyncService = $larkSyncService;
    }

    /**
     * Sync semua data dari Lark ke database
     */
    public function syncAll()
    {
        try {
            $result = $this->larkSyncService->syncAllClients();
            
            return response()->json([
                'success' => true,
                'message' => 'Sync completed successfully',
                'data' => $result
            ]);
            
        } catch (\Exception $e) {
            Log::error('Sync all error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Sync single record
     */
    public function syncSingle($recordId)
    {
        try {
            $result = $this->larkSyncService->syncByRecordId($recordId);
            
            return response()->json([
                'success' => true,
                'message' => 'Record synced successfully',
                'data' => $result
            ]);
            
        } catch (\Exception $e) {
            Log::error('Sync single error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user by lark record id
     */
    public function getUserByRecordId($recordId)
    {
        try {
            $user = $this->larkSyncService->getUserByLarkRecordId($recordId);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}