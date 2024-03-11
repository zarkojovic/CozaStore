<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCityUpdateRequest extends FormRequest {

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
            'city_name' => 'required|string|max:64',
            'country_id' => 'required|integer|exists:countries,id',
        ];
    }

}
