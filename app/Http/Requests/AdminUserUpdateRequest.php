<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserUpdateRequest extends FormRequest {

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
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'username' => 'required|string|max:32|unique:users,username,'.$this->route('user'),
            'email' => 'required|email|max:64|unique:users,email,'.$this->route('user'),
            'phone' => 'required|string|max:16',
            'password' => 'nullable|string|min:8|max:32',
            'password_confirmation' => 'same:password',
            'role_id' => 'required|exists:roles,id',
            'city_id' => 'exists:cities,id',
            'address' => 'string|max:64|nullable',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

}
