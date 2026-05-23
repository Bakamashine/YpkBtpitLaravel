<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на обновление товара. */
class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_name' => ['sometimes', 'string'],
            'ypk_id' => ['sometimes', 'uuid', 'exists:ypks,id'],
            'user_id' => ['sometimes', 'uuid', 'exists:users,id'],
            'status_product_id' => ['sometimes', 'uuid', 'exists:status_products,id'],
            'product_cost' => ['sometimes', 'numeric', 'regex:/^\d{1,7}(\.\d{1,2})?$/'],
            'product_info' => ['sometimes', 'string'],
            'is_product' => ['sometimes', 'boolean'],
            'photo_path' => ['nullable', 'string'],
            'address' => ['sometimes', 'string'],
        ];
    }
}
