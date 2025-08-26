<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePresensiRequest extends FormRequest
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
            'nama' => [
                'required',
                'string',
                'max:255'
            ],
            'institusi' => [
                'required',
                'string',
                'max:255'
            ],
            'lokasi_institusi' => [
                'required',
                'string',
            ],
            'bidang_institusi' => [
                'required',
                'string',
            ],
            'detail_institusi' => [
                'required',
                'string',
            ],
            'jabatan' => [
                'required',
                'string',
            ],
            'email' => [
                'string',
                'email',
                'max:255',
            ],
            'telpon' => [
                'required',
                'numeric',
                'digits_between:8,15',
            ],
            'kebutuhan' => [
                'required'
            ]
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    // public function attributes()
    // {
    //     return [
    //        'name' => 'Nama',
    //        'phone_number' => 'Nomer Handphone',
    //        'email' => 'Email',
    //        'pesan' => 'Pesan',
    //     ];
    // }
}
