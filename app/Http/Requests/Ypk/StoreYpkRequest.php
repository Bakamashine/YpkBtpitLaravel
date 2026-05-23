<?php

namespace App\Http\Requests\Ypk;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на создание УПК. */
class StoreYpkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ypk_name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
