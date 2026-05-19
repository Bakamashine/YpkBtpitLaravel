<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'uuid', 'exists:users,id'],
            'executor_id' => ['nullable', 'uuid', 'exists:users,id'],
            'product_id' => ['required', 'uuid', 'exists:products,id'],
            'status_order_id' => ['required', 'uuid', 'exists:status_orders,id'],
            'date' => ['required', 'date'],
            'customers_comment' => ['nullable', 'string', 'max:1500'],
            'user_comment' => ['nullable', 'string', 'max:1500'],
        ];
    }
}
