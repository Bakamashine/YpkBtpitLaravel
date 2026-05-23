<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация запроса на создание категории товаров/услуг.
 */
class StoreYpkRequest extends FormRequest
{
    /**
     * Разрешить выполнение запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации для создания категории.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ypk_name' => "required|string"
        ];
    }
}
