<?php

namespace App\Http\Requests\StatusProduct;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на обновление статуса товара. */
class UpdateStatusProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_name' => ['sometimes', 'string'],
        ];
    }
}
