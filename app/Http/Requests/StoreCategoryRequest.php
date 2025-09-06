<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:150'],
            'name_en' => ['nullable','string','max:150'],
            'slug' => ['nullable','alpha_dash','max:160','unique:categories,slug'],
            'description' => ['nullable','string','max:1000'],
            'description_en' => ['nullable','string','max:1000'],
            'meta_title' => ['nullable','string','max:160'],
            'meta_title_en' => ['nullable','string','max:160'],
            'meta_description' => ['nullable','string','max:500'],
            'meta_description_en' => ['nullable','string','max:500'],
            'is_active' => ['nullable','boolean'],
            'sort_order' => ['nullable','integer','min:0'],
        ];
    }
    
}
