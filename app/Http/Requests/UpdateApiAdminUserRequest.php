<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateApiAdminUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Id' => 'required|string',
            'Fullname' => 'required|string',
            'Password' => 'required|string',
            'PhoneNumber' => ['required', 'string', 'regex:/^\+7\d{10}$/', Rule::unique('users', 'phone_number')->ignore($this->input('Id'), 'id')],
            'UserInfo' => 'nullable|string',
            'Avatar' => 'nullable|image|mimetypes:image/jpeg,image/jpg,image/png,image/webp',
            'RoleId' => 'string|exists:roles,id'
        ];
    }
}
