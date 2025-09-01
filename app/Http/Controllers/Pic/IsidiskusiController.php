<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PresensiService;
use App\Models\DetailReportPresensi;

class IsidiskusiController extends Controller
{
    public $presensiService;
    
    public function __construct(PresensiService $presensiService)
    {
        $this->presensiService = $presensiService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            DetailReportPresensi::create([
                'report_id' => $request->input('report_id'),
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $findclient = $this->presensiService->show((int) $id);
        $findclient->load(['users', 'reportPresensis.detailReport']);

        return view('pic.client.discuss', compact('findclient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
