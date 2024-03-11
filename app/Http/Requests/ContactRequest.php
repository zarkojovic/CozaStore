<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest {

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
            'name' => 'required|max:32|min:3',
            'email' => 'required|email',
            'subject' => 'required|max:32|min:3|alpha',
            'message' => 'required|max:255|min:3|string',
        ];
    }

}
