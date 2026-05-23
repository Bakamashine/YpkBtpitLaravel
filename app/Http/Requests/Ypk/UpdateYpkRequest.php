<?php

namespace App\Http\Requests\Ypk;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на обновление УПК. */
class UpdateYpkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ypk_name' => ['sometimes', 'string'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
