<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServidorRequest extends FormRequest
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
            "categoria" => ["required","min:2"],
            "nombre" => ["required","min:2"],
            "ip" => ["required","min:8"],
            "puerto" => ["required","min:5"],
            "rcon" => ["required","min:1"],
        ];
    }
}
