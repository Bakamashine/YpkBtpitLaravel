<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация запроса на создание пользователя.
 */
class StoreUserRequest extends FormRequest
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
     * Правила валидации для создания пользователя.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'max:12', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'uuid', 'exists:roles,id'],
            'ypk_id' => ['nullable', 'uuid', 'exists:ypks,id'],
            'user_info' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'avatar' => ['nullable', 'image', 'mimetypes:image/jpeg,image/jpg,image/png,image/webp'],
        ];
    }
}
