<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $id = $this->route('category')?->id;
        return [
            'name' => ['sometimes','string','max:150'],
            'name_en' => ['sometimes','nullable','string','max:150'],
            'slug' => ['sometimes','alpha_dash','max:160','unique:categories,slug,'.$id],
            'description' => ['sometimes','nullable','string','max:1000'],
            'description_en' => ['sometimes','nullable','string','max:1000'],
            'meta_title' => ['sometimes','nullable','string','max:160'],
            'meta_title_en' => ['sometimes','nullable','string','max:160'],
            'meta_description' => ['sometimes','nullable','string','max:500'],
            'meta_description_en' => ['sometimes','nullable','string','max:500'],
            'is_active' => ['sometimes','boolean'],
            'sort_order' => ['sometimes','integer','min:0'],
        ];
    }
    
}
