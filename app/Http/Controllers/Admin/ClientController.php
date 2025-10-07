<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Enums\RoleUserEnum;
use App\Services\LarkBaseService;
use App\Services\LarkSyncService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    private $larkBaseService;
    private $larkSyncService;

    public function __construct(LarkBaseService $larkBaseService, LarkSyncService $larkSyncService)
    {
        $this->larkBaseService = $larkBaseService;
        $this->larkSyncService = $larkSyncService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('admin.client.index');
        try {
            $baseToken = config('services.lark.base_token');
            $tableId = config('services.lark.table_id');

            if (!$baseToken || !$tableId) {
                return back()->with('error', 'Base token atau Table ID belum dikonfigurasi');
            }

            // Ambil data dari Lark Base
            $rawRecords = $this->larkBaseService->getTableRecords($baseToken, $tableId);

            // Parse records
            $clients = $this->larkBaseService->parseRecords($rawRecords);

            return view('admin.client.index', compact('clients'));
        } catch (\Exception $e) {
            Log::error('Error di ClientController@index: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }
    /**
     * API endpoint untuk mendapatkan data real-time
     */
    public function getData()
    {
        try {
            $baseToken = config('services.lark.base_token');
            $tableId = config('services.lark.table_id');

            if (!$baseToken || !$tableId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Base token atau Table ID tidak dikonfigurasi'
                ], 500);
            }

            Log::info('Fetching data from Lark Base', [
                'base_token' => substr($baseToken, 0, 8) . '...',
                'table_id' => $tableId
            ]);

            $rawRecords = $this->larkBaseService->getTableRecords($baseToken, $tableId);
            $clients = $this->larkBaseService->parseRecords($rawRecords);

            return response()->json([
                'success' => true,
                'data' => $clients,
                'total' => count($clients)
            ]);
        } catch (\Exception $e) {
            Log::error('Error di ClientController@getData: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location_company' => ['required', 'string', 'max:255'],
            'field_company' => ['required', 'string', 'max:255'],
            'detail_company' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'name'      => 'required|string|max:255',
            // 'email'     => 'required|email|unique:users,email',
            // 'phone'     => 'required|string|max:20',
            // 'job_title' => 'required|string|max:255',
            // 'company'   => 'required|string|max:255',
            // 'location_company' => 'required|string',
            // 'location_city'    => 'required|string',
            // 'field_company'    => 'required|string',
            // 'detail_company'   => 'required|string',
            // 'password'  => 'required|string|min:8|confirmed',
        ]);

        // generate client ID (misalnya CUST-2025-001)
        $lastId = User::where('role', 'customer')->max('id');

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'job_title' => $request->job_title,
            'company' => $request->company,
            'location_company' => $request->location_city . ', ' . $request->location_company,
            'field_company' => $request->field_company,
            'detail_company' => $request->detail_company,
            'status'    => 'active',
            'role' => RoleUserEnum::customer,
            // 'name'      => $validated['name'],
            // 'email'     => $validated['email'],
            // 'phone'     => $validated['phone'],
            // 'job_title' => $validated['job_title'],
            // 'company'   => $validated['company'],
            // 'location_company' => $request->location_city . ', ' . $request->location_company,
            // 'field_company' => $validated['field_company'],
            // 'detail_company' => $validated['detail_company'],
            // 'status'    => 'active',
            // 'role'      => 'customer',
            // 'password'  => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Client berhasil ditambahkan',
            'data'    => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Get single client data untuk edit
     */
    public function edit($recordId)
    {
        try {
            $baseToken = config('services.lark.base_token');
            $tableId = config('services.lark.table_id');
            
            $record = $this->larkBaseService->getRecord($baseToken, $tableId, $recordId);
            
            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            // Parse record
            $parsedRecord = [
                'record_id' => $record['record_id'],
                'fields' => $record['fields']
            ];
            
            return response()->json([
                'success' => true,
                'data' => $parsedRecord
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error di ClientController@edit: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update client data di Lark Base
     */
    public function update(Request $request, $recordId)
    {
        try {
            $validator = Validator::make($request->all(), [
                'Company' => 'required|string|max:255',
                'Status Step Client' => 'nullable|string|max:255',
                'Business' => 'nullable|string|max:255',
                'Industry' => 'nullable|string|max:255',
                'Phone number (Office)' => 'nullable|string|max:50',
                'City, Province (Office)' => 'nullable|string|max:255',
                'City, Province (Project)' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $baseToken = config('services.lark.base_token');
            $tableId = config('services.lark.table_id');
            
            $fields = [];
            
            if ($request->has('Company')) {
                $fields['Company'] = $request->input('Company');
            }
            if ($request->has('Status Step Client')) {
                $fields['Status Step Client'] = $request->input('Status Step Client');
            }
            if ($request->has('Business')) {
                $fields['Business'] = $request->input('Business');
            }
            if ($request->has('Industry')) {
                $fields['Industry'] = $request->input('Industry');
            }
            if ($request->has('Phone number (Office)')) {
                $fields['Phone number (Office)'] = $request->input('Phone number (Office)');
            }
            if ($request->has('City, Province (Office)')) {
                $fields['City, Province (Office)'] = $request->input('City, Province (Office)');
            }
            if ($request->has('City, Province (Project)')) {
                $fields['City, Province (Project)'] = $request->input('City, Province (Project)');
            }

            Log::info('Updating client', [
                'record_id' => $recordId,
                'fields' => $fields
            ]);

            $updatedRecord = $this->larkBaseService->updateRecord(
                $baseToken, 
                $tableId, 
                $recordId, 
                $fields
            );

            // Auto sync ke database setelah update
            try {
                $this->larkSyncService->syncByRecordId($recordId);
            } catch (\Exception $e) {
                Log::warning('Auto sync failed after update: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $updatedRecord
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error di ClientController@update: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Ambil data dari Lark Sheet dan kembalikan sebagai JSON
     */
    // public function larkSheetData(Request $request)
    // {
    //     $sheetToken = config('services.lark.sheet_token'); // simpan token sheet di config/services.php
    //     $lark = new LarkSheetService($sheetToken);
    //     $data = $lark->getSheetData();
    //     return response()->json(['data' => $data]);
    // }
}
