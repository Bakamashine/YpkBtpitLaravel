<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на обновление роли. */
class UpdateRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role_name' => ['sometimes', 'string', 'max:50'],
        ];
    }
}
