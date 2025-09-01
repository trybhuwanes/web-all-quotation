<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactusRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'phone' => [
                'required',
                'numeric',
                'digits_between:8,15',
            ],
            'email' => [
                'string',
                'email',
                'max:255',
            ],
            'description' => [
                'required'
            ],
            // 'g-recaptcha-response' => 'required|captcha',
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
           'name' => 'Nama',
           'email' => 'Email',
           'phone' => 'Nomer Telpon',
           'description' => 'Pesan',
           'g-recaptcha-response' => 'Captcha',
        ];
    }
}
