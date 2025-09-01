<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use App\Models\Revision_quot;
use Illuminate\Http\Request;
use App\Services\RevisionService;

class RevisionquotController extends Controller
{

    // public $revisionService;
    
    // public function __construct(RevisionService $revisionService)
    // {
    //     $this->$revisionService = $revisionService;
    // }
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
            $lastRevision = Revision_quot::where('order_id', $request->order_id)->max('revision_number');
            // Increment revision_number dan tambahkan padding nol di depan
            $newRevisionNumber = str_pad(($lastRevision ?? 0) + 1, 2, '0', STR_PAD_LEFT);

            $user = Revision_quot::create([
                'order_id' => $request->order_id,
                'revision_number' => $newRevisionNumber,
                'revision_description' => $request->revision_description ?? null, ]);
            Session()->flash('status', 'Revisi berhasi di Buat.');

            return response()->json([
                'success' => true,
                'message' => 'Revisi berhasil di Buat.',
                'data'    => $user,
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
        try {
            $rev = Revision_quot::where('id', $id)->select('id')->firstOrFail();
            $rev->revision_number = $request->input('revision_number');
            $rev->revision_description = $request->input('revision_description');
            $rev->save();
            Session()->flash('status', 'Revisi di update.');

            return response()->json([
                'success' => true,
                'message' => 'Revisi di update.',
                'data'    => $rev,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
