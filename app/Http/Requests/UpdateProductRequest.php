<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $id = $this->route('product')?->id;
        return [
            'category_id' => ['sometimes','exists:categories,id'],
            'name' => ['sometimes','string','max:180'],
            'name_en' => ['sometimes','nullable','string','max:180'],
            'slug' => ['sometimes','alpha_dash','max:190','unique:products,slug,'.$id],
            'sku' => ['sometimes','nullable','string','max:80'],
            'hero_image' => ['sometimes','nullable','image','mimes:jpeg,png,jpg,gif,webp','max:10240'],
            'short_description' => ['sometimes','nullable','string','max:1000'],
            'short_description_en' => ['sometimes','nullable','string','max:1000'],
            'description' => ['sometimes','nullable','string'],
            'description_en' => ['sometimes','nullable','string'],
            'specs' => ['sometimes','nullable','array'],
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
            'meta_title' => ['sometimes','nullable','string','max:160'],
            'meta_title_en' => ['sometimes','nullable','string','max:160'],
            'meta_description' => ['sometimes','nullable','string','max:500'],
            'meta_description_en' => ['sometimes','nullable','string','max:500'],
            'is_active' => ['sometimes','boolean','in:0,1'],
            'images' => ['sometimes','array'],
            'images.*.path' => ['required_with:images','string'],
            'images.*.sort_order' => ['nullable','integer','min:0'],
        ];
    }
    
}
