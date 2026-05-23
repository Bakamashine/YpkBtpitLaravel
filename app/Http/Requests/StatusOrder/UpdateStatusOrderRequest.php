<?php

namespace App\Http\Requests\StatusOrder;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на обновление статуса заказа. */
class UpdateStatusOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_name' => ['sometimes', 'string'],
        ];
    }
}
