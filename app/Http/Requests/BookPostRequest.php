<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "collection_code" => "required|unique:books|sometimes",
            "collection_title" => "required",
            "author" => "required",
            "publisher" => "required",
            "stock" => "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "collection_code.required" => "Kode koleksi wajib diisi.",
            "collection_code.unique" => "Kode koleksi harus berbeda.",
            "collection_title.required" => "Judul koleksi wajib diisi.",
            "author.required" => "Pengarang wajib diisi.",
            "publisher.required" => "Penerbit wajib diisi.",
            "stock.required" => "Jumlah koleksi wajib diisi.",
        ];
    }
}
