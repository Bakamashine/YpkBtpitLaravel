<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация запроса на обновление категории товаров/услуг (не используется).
 */
class UpdateYpkRequest extends FormRequest
{
    /**
     * Разрешить выполнение запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Правила валидации (заглушка — метод не используется).
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
