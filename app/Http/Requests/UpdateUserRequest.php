<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация запроса на обновление пользователя.
 */
class UpdateUserRequest extends FormRequest
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
     * Правила валидации для обновления пользователя.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:150'],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'phone_number' => ['sometimes', 'string', 'max:12', Rule::unique('users')->ignore($this->route('user'))],
            'password' => ['nullable', 'string', 'min:8'],
            'role_id' => ['sometimes', 'uuid', 'exists:roles,id'],
            'ypk_id' => ['nullable', 'uuid', 'exists:ypks,id'],
            'user_info' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'avatar' => ['nullable', 'image', 'mimetypes:image/jpeg,image/jpg,image/png,image/webp'],
        ];
    }
}
