<?php

namespace App\Http\Requests\SelectedProduct;

use Illuminate\Foundation\Http\FormRequest;

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
