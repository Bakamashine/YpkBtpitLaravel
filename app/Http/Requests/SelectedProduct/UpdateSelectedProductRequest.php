<?php

namespace App\Http\Requests\SelectedProduct;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на обновление выбранного товара. */
class UpdateSelectedProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'uuid', 'exists:users,id'],
            'product_id' => ['sometimes', 'uuid', 'exists:products,id'],
        ];
    }
}
