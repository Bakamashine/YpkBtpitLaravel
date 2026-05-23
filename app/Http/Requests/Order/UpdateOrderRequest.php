<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

/** Валидация запроса на обновление заказа. */
class UpdateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => ['sometimes', 'uuid', 'exists:users,id'],
            'executor_id' => ['nullable', 'uuid', 'exists:users,id'],
            'product_id' => ['sometimes', 'uuid', 'exists:products,id'],
            'status_order_id' => ['sometimes', 'uuid', 'exists:status_orders,id'],
            'date' => ['sometimes', 'date'],
            'customers_comment' => ['nullable', 'string', 'max:1500'],
            'user_comment' => ['nullable', 'string', 'max:1500'],
        ];
    }
}
