<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateApiCurrentUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Fullname' => 'required|string',
            'PhoneNumber' => ['required', 'string', 'regex:/^\+7\d{10}$/', Rule::unique('users', 'phone_number')->ignore($this->user()->id)],
            'UserInfo' => 'nullable|string',
            'Avatar' => 'nullable|image|mimetypes:image/jpeg,image/jpg,image/png,image/webp',
        ];
    }
}
