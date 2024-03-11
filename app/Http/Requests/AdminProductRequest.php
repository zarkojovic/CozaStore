<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductRequest extends FormRequest {

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
            'title' => 'required|string|max:64',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
            'colors' => 'array',
            'colors.*' => 'required|numeric|exists:colors,id',
            'sizes' => 'array',
            'sizes.*' => 'required|numeric|exists:sizes,id',
            'tags' => 'array',
            'tags.*' => 'required|numeric|exists:tags,id',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

}
