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
            'name_en' => ['nullable','string','max:180'],
            'slug' => ['nullable','alpha_dash','max:190','unique:products,slug'],
            'sku' => ['nullable','string','max:80'],
            'hero_image' => ['nullable','image','mimes:jpeg,png,jpg,gif,webp','max:10240'],
            'short_description' => ['nullable','string','max:1000'],
            'short_description_en' => ['nullable','string','max:1000'],
            'description' => ['nullable','string'],
            'description_en' => ['nullable','string'],
            'specs' => ['nullable','array'],
            'option_tables' => ['sometimes','array'],
            'option_tables.*.title' => ['nullable','string','max:200'],
            'option_tables.*.title_en' => ['nullable','string','max:200'],
            'option_tables.*.description' => ['nullable','string','max:500'],
            'option_tables.*.description_en' => ['nullable','string','max:500'],
            'option_tables.*.columns' => ['required_with:option_tables','array','min:1'],
            'option_tables.*.columns.*' => ['required','string','max:120'],
            'option_tables.*.columns_en' => ['sometimes','array'],
            'option_tables.*.columns_en.*' => ['nullable','string','max:120'],
            'option_tables.*.rows' => ['required_with:option_tables','array'],
            'option_tables.*.rows.*' => ['array'],
            'option_tables.*.rows.*.*' => ['nullable','string'],
            'meta_title' => ['nullable','string','max:160'],
            'meta_title_en' => ['nullable','string','max:160'],
            'meta_description' => ['nullable','string','max:500'],
            'meta_description_en' => ['nullable','string','max:500'],
            'is_active' => ['nullable','boolean','in:0,1'],
            'images' => ['nullable','array'],
            'images.*.path' => ['required_with:images','string'],
            'images.*.sort_order' => ['nullable','integer','min:0'],
        ];
    }
    
}
