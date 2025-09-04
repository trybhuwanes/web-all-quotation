<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ActiveStatusMail;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter['search'] = $request->q;
        $filter['status'] = $request->status;

        $alluser        = $this->userService
            ->filtering($filter)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.user-manage.index', compact('alluser'));
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
        $us = User::where('id', $id)->first();
        return view('admin.user-manage.edit_user', compact('us'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        try {
            $user = User::where('id', $id)->select('id', 'email', 'name')->firstOrFail();


            $user = $this->userService->update($request->all(), $user);
            Mail::to($user['email'])->locale(app()->getLocale())->send(new ActiveStatusMail($user));
            Session()->flash('status', 'Data Pengguna Berhasil Update');

            return response()->json([
                'success' => true,
                'message' => 'Data Pengguna Berhasil Update',
                'data'    => $user,
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

    /**
     * Update the specified resource in storage.
     */
    public function updateStatusAccount(Request $request, string $id)
    {
        //
        try {
            $user = User::where('id', $id)->select('id')->firstOrFail();
            $user = $this->userService->update($request->all(), $user);
            Session()->flash('status', 'User update.');

            return response()->json([
                'success' => true,
                'message' => 'User Update.',
                'data'    => $user,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }
}
