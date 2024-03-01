<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'first_name' => 'required|string|max:32|min:3|alpha',
            'last_name' => 'required|string|max:32|min:3|alpha',
            'username' => 'required|string|max:32|min:3|alpha|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'confirm-password' => 'required|same:password',
            'phone' => 'required|numeric',
            'terms' => 'required',
        ];
    }

}
