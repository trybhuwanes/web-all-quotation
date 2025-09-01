<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangesignacountController extends Controller
{
    //
    public $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePass(Request $request, string $id)
    {
        //
        try {
            $validated = $request->validate([
                'new_password' => 'required|string|min:8|', Password::defaults(),
                'confirm_password' => 'required|same:new_password',
            ]);
            $user = User::where('id', $id)->select('id', 'password')->firstOrFail();
            $user = $user->update([
                'password' => Hash::make($validated['new_password']),
            ]);
            Session()->flash('status', 'Password Update');

            return response()->json([
                'success' => true,
                'message' => 'Password Update',
                'data'    => $user,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }

    }

     /**
     * Update the specified resource in storage.
     */
    public function updateMail(Request $request, string $id)
    {
        //
        // dd($request->all());
        try {
            

            $validated = $request->validate([
                'new_email' => 'required|email|unique:users,email', // pastikan email baru valid dan unik
                'current_password' => 'required',
            ]);
        
            // Ambil user yang sedang login
            // $user = Auth::user();

            $user = User::where('id', $id)->select('id', 'password', 'email')->firstOrFail();
        
            // Periksa apakah current_password cocok dengan password yang ada di database
            if (!Hash::check($request->current_password, $user->password)) {
                throw new \Exception('Konfirmasi kata sandi saat ini tidak sesuai.');
            }
        
            // Jika validasi berhasil, update email pengguna
            $user->email = $validated['new_password'];
            $user->save();
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
