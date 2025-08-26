<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PresensiService;
use Illuminate\Support\Facades\Log;
use App\Models\Presensi;
use App\Models\DetailReportPresensi;

class ClientController extends Controller
{
    public $presensiService;
    
    public function __construct(PresensiService $presensiService)
    {
        $this->presensiService = $presensiService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = auth()->user();

        // Pastikan user adalah PIC
        if ($user->role !== 'pic') {
            abort(403, 'Unauthorized action.');
        }
        $filter['search']  = $request->q;
        $myclient         = $this->presensiService
                            ->filtering($filter)->whereHas('users', function ($query) use ($user) {
                                $query->where('user_id', $user->id);
                            })->with(['users', 'reportPresensis.detailReport'])->orderBy('status_pic', 'asc')
                            ->paginate(10);

        return view('pic.client.index', compact('myclient'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            DetailReportPresensi::where('id', $request->input('detail_report_id'))->update([
                'diskusi' => $request->input('message'),
                'next_todo' => $request->input('next_todo')
            ]);
            Session()->flash('status', __('notification.save_success'));

            return response()->json([
                'success' => true,
                'message' => __('notification.save_success'),
            ]);

        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $findclient = Presensi::with(['users', 'reportPresensis.detailReport'])->findOrFail($id);
        return view('pic.client.show', compact('findclient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // Ambil data berdasarkan ID
        $findclient = $this->presensiService->show((int) $id);
        // Muat relasi yang dibutuhkan
        $findclient->load(['users', 'reportPresensis.detailReport']);
        // dd($findclient);
        return view('pic.client.edit', compact('findclient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        Log::info($request->all());
        // dd($request->all());
        // dd($id);
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
