<?php

namespace App\Http\Requests\SelectedProduct;

use Illuminate\Foundation\Http\FormRequest;

class StoreSelectedProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'uuid', 'exists:users,id'],
            'product_id' => ['required', 'uuid', 'exists:products,id'],
        ];
    }
}
