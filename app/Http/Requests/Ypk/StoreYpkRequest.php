<?php

namespace App\Http\Requests\Ypk;

use Illuminate\Foundation\Http\FormRequest;

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
