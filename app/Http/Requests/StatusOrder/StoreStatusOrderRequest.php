<?php

namespace App\Http\Requests\StatusOrder;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на создание статуса заказа. */
class StoreStatusOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_name' => ['required', 'string'],
        ];
    }
}
