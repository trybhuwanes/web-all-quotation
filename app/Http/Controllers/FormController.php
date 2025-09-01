<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PresensiService;
use App\Http\Requests\CreatePresensiRequest;

class FormController extends Controller
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
    public function store(CreatePresensiRequest $request)
    {
        
        try {
            $data = $request->all();
            $tags = json_decode($request->input('tgl_hadir'), true);
            $data['tgl_hadir'] = array_column($tags, 'value');
            
            $linkedAccount = $this->presensiService->create($data);
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
