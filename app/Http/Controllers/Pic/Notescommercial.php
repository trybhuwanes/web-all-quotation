<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use App\Models\Notes_commercial;
use Illuminate\Http\Request;

class Notescommercial extends Controller
{
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
        $note = Notes_commercial::where('id', $id)->with('order')->first();
        return view('form-modal._form-additional-note', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $note = Notes_commercial::findOrFail($request->id);
            $note->notes_description = $request->input('notes_description');
            $note->save();

            Session()->flash('status', 'Catatan di Simpan.');

            return response()->json([
                'success' => true,
                'message' => 'Catatan di Simpan.',
                'data'    => $note,
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
