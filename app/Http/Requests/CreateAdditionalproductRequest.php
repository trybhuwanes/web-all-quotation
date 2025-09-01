<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdditionalproductRequest extends FormRequest
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
            'nama_produk_tambahan' => [
                'required',
                'string',
                'max:255'
            ],
            'harga_produk_tambahan' => [
                'required',
            ],
            'deskripsi_produk_tambahan' => [
                'required',
                'string',
            ],
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
           'nama_produk_tambahan' => 'Nama produk tambahan',
           'harga_produk_tambahan' => 'Harga produk tambahan',
           'deskripsi_produk_tambahan' => 'Deskripsi produk tambahan',
        ];
    }
}
