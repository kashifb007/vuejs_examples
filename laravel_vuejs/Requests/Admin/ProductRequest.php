<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user has authorization to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && $this->user()->isAbleTo(['products-create', 'products-update']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255', 'string'],
        ];
    }
}
