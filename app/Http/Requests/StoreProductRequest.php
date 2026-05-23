<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|string',
            'ypk_id' => 'required|exists:ypks,id',
            'status_product_id' => 'required|exists:status_products,id',
            'product_cost' => 'required|string',
            'product_info' => 'required|string',
            'is_product' => 'required|boolean',
            'photo_path' => 'nullable|image|mimetypes:image/jpeg,image/jpg,image/png,image/webp',
            'address' => 'required|string'
        ];
    }
}
