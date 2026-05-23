<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на создание роли. */
class StoreRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role_name' => ['required', 'string', 'max:50'],
        ];
    }
}
