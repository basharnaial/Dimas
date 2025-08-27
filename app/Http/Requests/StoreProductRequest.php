<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id' => ['required','exists:categories,id'],
            'name' => ['required','string','max:180'],
            'slug' => ['nullable','alpha_dash','max:190','unique:products,slug'],
            'sku' => ['nullable','string','max:80'],
            'hero_image' => ['nullable','string','max:255'],
            'short_description' => ['nullable','string','max:1000'],
            'description' => ['nullable','string'],
            'specs' => ['nullable','array'],
            'meta_title' => ['nullable','string','max:160'],
            'meta_description' => ['nullable','string','max:500'],
            'images' => ['nullable','array'],
            'images.*.path' => ['required_with:images','string'],
            'images.*.sort_order' => ['nullable','integer','min:0'],
        ];
    }
    
}
