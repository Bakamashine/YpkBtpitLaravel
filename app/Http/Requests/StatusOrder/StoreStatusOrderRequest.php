<?php

namespace App\Http\Requests\StatusOrder;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatusOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_name' => ['required', 'string'],
        ];
    }
}
