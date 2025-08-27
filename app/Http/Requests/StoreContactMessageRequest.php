<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Public contact form
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
            'email' => ['nullable','email','max:150'],
            'phone' => ['nullable','string','max:30'],
            'message' => ['required','string','max:5000'],
            'consent' => ['boolean'],
            'trap_field' => ['nullable', 'max:0'], // Honeypot field - must be empty
        ];
    }

    /**
     * Get the validated data from the request.
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        
        // Remove honeypot field from validated data
        unset($validated['trap_field']);
        
        return $validated;
    }
    
}
