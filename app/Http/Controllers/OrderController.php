<?php

namespace App\Http\Controllers;

use App\Enums\StatusOrderEnum;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\StatusOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Product $product)
    {
        return view('orders.create', compact('product'));
    }

    public function store(StoreOrderRequest $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $status = StatusOrder::firstOrCreate(
            ['status_name' => StatusOrderEnum::New->value],
        );

        $exists = Order::where('customer_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->where('status_order_id', $status->id)
            ->exists();

        if ($exists) {
            return to_route('product.show', $product)->with('error', 'Заказ уже существует');
        }

        $request->user()->customerOrders()->create([
            'executor_id' => $product->user_id,
            'product_id' => $product->id,
            'status_order_id' => $status->id,
            'date' => now(),
            'customers_comment' => $request->validated('customers_comment'),
        ]);

        return to_route('product.show', $product)->with('success', 'Заказ успешно оформлен!');
    }

    public function management(Request $request)
    {
        $statuses = StatusOrder::all();
        $orders = Order::with('product', 'customer', 'statusOrder')
            ->when($request->input('search'), function ($query, $search) {
                $query->whereHas('product', fn($q) => $q->where('product_name', 'like', "%{$search}%"))
                    ->orWhereHas('customer', fn($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->orderByDesc('created_at')
            ->paginate(6)
            ->withQueryString();

        return view('orders.management', compact('orders', 'statuses'));
    }

    public function close(Order $order)
    {
        $completed = StatusOrder::firstOrCreate(
            ['status_name' => StatusOrderEnum::Completed->value],
        );
        $order->update(['status_order_id' => $completed->id]);

        return back()->with('success', 'Заказ закрыт');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status_order_id' => ['required', 'exists:status_orders,id'],
        ]);

        $order->update(['status_order_id' => $request->input('status_order_id')]);

        return back()->with('success', 'Статус заказа обновлён');
    }
}
