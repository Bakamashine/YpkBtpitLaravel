<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreApiUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Fullname' => 'required|string',
            'Password' => 'required|string',
            'PhoneNumber' => ['required', 'string', 'regex:/^\+7\d{10}$/', 'unique:users,phone_number'],
            'UserInfo' => 'nullable|string',
            'Avatar' => 'nullable|image|mimetypes:image/jpeg,image/jpg,image/png,image/webp',
            'RoleId' => 'string|exists:roles,id'
        ];
    }
}
