<?php

namespace App\Http\Requests;

use App\Enums\AccountStatusEnum;
use App\Enums\RoleUserEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class CreatepicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nama' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'notelpon' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
           'nama' => 'Nama Lengkap',
           'email' => 'Email',
           'job_title' => 'Jabatan',
           'company' => 'Perusahaan',
           'notelpon' => 'Nomer Telpon',
           'password' => 'Password',
           'password_confirmation' => 'Re Password',
        ];
    }
}
