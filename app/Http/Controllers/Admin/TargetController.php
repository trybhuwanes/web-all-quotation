<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Target;
use App\Models\User;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter['search'] = $request->q;
        $currentMonth = now()->month;
        $currentYear  = now()->year;

        $targets = User::select('id', 'name')
            ->where('role', 'pic')
            ->where('status', 'active')
            ->with(['targets' => function ($q) use ($currentYear) {
                $q->where('year', $currentYear); // ambil semua bulan di tahun ini
            }])
            ->orderBy('id')
            ->get();

        return view('admin.target.index', compact('targets', 'currentYear'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'month'  => 'required|integer',
            'target' => 'required|numeric',
            'year'   => 'required|integer',
            'pic_id' => 'required|exists:users,id',
        ]);

        try {
            $target = Target::create([
                'month'  => $request->month,
                'target' => $request->target,
                'year'   => $request->year,
                'pic_id' => $request->pic_id,
            ]);
            Session()->flash('status', 'Kategori berhasil dibuat.');

            return response()->json([
                'success' => true,
                'message' => 'Target successfully created.',
                'data'    => $target,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $detailuser = User::findOrFail($id);
            $targets = $detailuser->targets()
                ->orderBy('year', 'desc')
                ->orderBy('month', 'asc')
                ->paginate(12);

            $lastTarget = $detailuser->targets()
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->first();

            return view('admin.target.show', compact('detailuser', 'targets', 'lastTarget'));
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'month'  => 'required|integer|min:1|max:12',
            'target' => 'required|numeric|min:0',
        ]);

        try {
            $target = Target::findOrFail($id);
            $target->update([
                'month'  => $request->month,
                'target' => $request->target,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Target updated.',
                'data'    => $target,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
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
}
