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
        return false;
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
            'slug' => ['sometimes','alpha_dash','max:190','unique:products,slug,'.$id],
            'sku' => ['sometimes','nullable','string','max:80'],
            'hero_image' => ['sometimes','nullable','string','max:255'],
            'short_description' => ['sometimes','nullable','string','max:1000'],
            'description' => ['sometimes','nullable','string'],
            'specs' => ['sometimes','nullable','array'],
            'meta_title' => ['sometimes','nullable','string','max:160'],
            'meta_description' => ['sometimes','nullable','string','max:500'],
            'images' => ['sometimes','array'],
            'images.*.path' => ['required_with:images','string'],
            'images.*.sort_order' => ['nullable','integer','min:0'],
        ];
    }
    
}
