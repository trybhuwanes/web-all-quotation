<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Enums\RoleUserEnum;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location_company' => ['required', 'string', 'max:255'],
            'field_company' => ['required', 'string', 'max:255'],
            'detail_company' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ]);

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
            'role' => RoleUserEnum::customer,
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Anda akan dihubungi untuk verifikasi akun.');
    
    }
}
