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
        return false;
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
            /**
             * 🚨 قاعدة مهمة جداً:
             * 
             * 'unique:categories,slug,'.$id
             * 
             * �� يتحقق من أن slug فريد، لكن يستثني الفئة الحالية
             * 
             * ❌ بدون استثناء: خطأ "slug مستخدم مسبقاً" عند التحديث
             * ✅ مع استثناء: يمكن تحديث الفئة بدون تغيير slug
             * 
             * 💡 مثال: فئة "electronics" يمكن تحديثها بدون تغيير slug
             * 
                        *  * 📝 Example:
            * - Category ID 5 has slug "electronics"
            * - Update same category: "electronics" is allowed ✅
            * - Update different category: "electronics" is blocked ❌
            * 
            * 🚨 NEVER FORGET: Always exclude current record ID in update requests!
         */
            'slug' => ['sometimes','alpha_dash','max:160','unique:categories,slug,'.$id],
            'meta_title' => ['sometimes','nullable','string','max:160'],
            'meta_description' => ['sometimes','nullable','string','max:500'],
        ];
    }
    
}
