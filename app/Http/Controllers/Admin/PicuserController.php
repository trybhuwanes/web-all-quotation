<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreatepicRequest;
use App\Models\User;
use Illuminate\Support\Str;
use App\Enums\AccountStatusEnum;
use App\Enums\RoleUserEnum;
use Carbon\Carbon;

class PicuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    
    /**
     * Show the confirm password view.
     */
    public function create(): View
    {
        return view('admin.userpic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatepicRequest $request)
    {
        // dd($request->all());
        try {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'name' => $request->input('nama'),
                'phone' => $request->input('notelpon'),
                'job_title' => $request->input('job_title'),
                'company' => $request->input('company'),
                'photo' => null,
                'status' => AccountStatusEnum::active,
                'role' => RoleUserEnum::pic,
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(10),
            ]);
            return response()->json([
                'success' => true,
                'message' => __('notification.save_success'),
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => __('notification.save_failed'),
            ], 500);
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
