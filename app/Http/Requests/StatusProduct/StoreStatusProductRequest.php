<?php

namespace App\Http\Requests\StatusProduct;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на создание статуса товара. */
class StoreStatusProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_name' => ['required', 'string'],
        ];
    }
}
