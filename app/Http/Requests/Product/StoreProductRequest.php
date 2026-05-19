<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string'],
            'ypk_id' => ['required', 'uuid', 'exists:ypks,id'],
            'user_id' => ['required', 'uuid', 'exists:users,id'],
            'status_product_id' => ['required', 'uuid', 'exists:status_products,id'],
            'product_cost' => ['required', 'numeric', 'regex:/^\d{1,7}(\.\d{1,2})?$/'],
            'product_info' => ['required', 'string'],
            'is_product' => ['required', 'boolean'],
            'photo_path' => ['nullable', 'string'],
            'address' => ['required', 'string'],
        ];
    }
}
