<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repository\IOrderRepository;
use App\Enums\StatusOrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderApiRequest;
use App\Http\Requests\UpdateOrderApiRequest;
use App\Http\Resources\OrderApiCollection;
use App\Http\Resources\OrderApiResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class OrderController extends Controller
{

    public function __construct(private IOrderRepository $repository)
    {

    }

    #[OA\Get(
        path: '/api/order/manager',
        summary: 'Получить заказы по роли (Админ видит все, Менеджер видит свои заказы)',
        security: [['bearerAuth' => []]],
        tags: ['Заказы'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'executorId', type: 'string', nullable: true),
                    new OA\Property(property: 'customerId', type: 'string'),
                    new OA\Property(property: 'date', type: 'string'),
                    new OA\Property(property: 'statusName', type: 'string'),
                    new OA\Property(property: 'customersName', type: 'string', nullable: true),
                    new OA\Property(property: 'userComment', type: 'string', nullable: true),
                    new OA\Property(property: 'productDto', type: 'object'),
                ])
            )),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
        ]
    )]
    public function getAllForManager(Request $request)
    {
        $orders = $this->repository->getByRole($request->user());
        return new OrderApiCollection($orders);
    }

    public function getAllForAdmin()
    {

    }

    #[OA\Get(
        path: '/api/order/all',
        summary: 'Получить все заказы',
        tags: ['Заказы'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'executorId', type: 'string', nullable: true),
                    new OA\Property(property: 'customerId', type: 'string'),
                    new OA\Property(property: 'date', type: 'string'),
                    new OA\Property(property: 'statusName', type: 'string'),
                    new OA\Property(property: 'customersName', type: 'string', nullable: true),
                    new OA\Property(property: 'userComment', type: 'string', nullable: true),
                    new OA\Property(property: 'productDto', type: 'object'),
                ])
            )),
        ]
    )]
    public function getAll()
    {
        return new OrderApiCollection(Order::all());
    }

    #[OA\Get(
        path: '/api/order/{order}',
        summary: 'Получить заказ по ID',
        tags: ['Заказы'],
        parameters: [
            new OA\Parameter(name: 'order', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'executorId', type: 'string', nullable: true),
                    new OA\Property(property: 'customerId', type: 'string'),
                    new OA\Property(property: 'date', type: 'string'),
                    new OA\Property(property: 'statusName', type: 'string'),
                    new OA\Property(property: 'customersName', type: 'string', nullable: true),
                    new OA\Property(property: 'userComment', type: 'string', nullable: true),
                    new OA\Property(property: 'productDto', type: 'object'),
                ]
            )),
            new OA\Response(response: 404, description: 'Заказ не найден', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function getById(Request $request, Order $order)
    {
        if ($order->customer_id != $request->user()->id) {
            abort(403);
        }
        return new OrderApiResource($order);
    }

    #[OA\Delete(
        path: '/api/order/{order}',
        summary: 'Удалить заказ по ID',
        security: [['bearerAuth' => []]],
        tags: ['Заказы'],
        parameters: [
            new OA\Parameter(name: 'order', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Удалено', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 404, description: 'Заказ не найден', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function destroy(Order $order)
    {
        $order->delete();
        return response(status: 204);
    }

    #[OA\Post(
        path: '/api/order',
        summary: 'Создать заказ',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'productId', type: 'string'),
                    new OA\Property(property: 'customersComment', type: 'string'),
                    new OA\Property(property: 'userComment', type: 'string'),
                ]
            )
        ),
        tags: ['Заказы'],
        responses: [
            new OA\Response(response: 200, description: 'Создано', content: new OA\JsonContent(properties: [])),
        ]
    )]
    public function store(StoreOrderApiRequest $request)
    {

        $product = Product::findOrFail($request->productId);
        $status = StatusOrder::firstOrCreate(
            ['status_name' => StatusOrderEnum::New->value],
        );

        $exists = Order::where('customer_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->where('status_order_id', $status->id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => "Заказ уже существует"]);
//            return to_route('product.show', $product)->with('error', 'Заказ уже существует');
        }

        $request->user()->customerOrders()->create([
            'executor_id' => $product->user_id,
            'product_id' => $product->id,
            'status_order_id' => $status->id,
            'date' => now(),
            'customers_comment' => $request->customersComment,
        ]);

//        $request->user()->orders([
//            'product_id' => $request->productId,
//            'user_comment' => $request->userComment,
//            'customers_comment' => $request->customersComment
//        ]);

        return response(status: 200);
    }

    #[OA\Get(
        path: '/api/order/user',
        summary: 'Получить заказы текущего пользователя',
        security: [['bearerAuth' => []]],
        tags: ['Заказы'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'executorId', type: 'string', nullable: true),
                    new OA\Property(property: 'customerId', type: 'string'),
                    new OA\Property(property: 'date', type: 'string'),
                    new OA\Property(property: 'statusName', type: 'string'),
                    new OA\Property(property: 'customersName', type: 'string', nullable: true),
                    new OA\Property(property: 'userComment', type: 'string', nullable: true),
                    new OA\Property(property: 'productDto', type: 'object'),
                ])
            )),
            new OA\Response(response: 401, description: 'Не авторизован'),
        ]
    )]
    public function getForUser(Request $request)
    {
        return new OrderApiCollection($request->user()->orders()->get());
    }

    #[OA\Put(
        path: '/api/order',
        summary: 'Обновить заказ (админ/менеджер)',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'productId', type: 'string'),
                    new OA\Property(property: 'statusOrderId', type: 'string'),
                    new OA\Property(property: 'executorId', type: 'string'),
                    new OA\Property(property: 'customersComment', type: 'string'),
                    new OA\Property(property: 'userComment', type: 'string'),
                ]
            )
        ),
        tags: ['Заказы'],
        responses: [
            new OA\Response(response: 200, description: 'Обновлено', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'executorId', type: 'string', nullable: true),
                    new OA\Property(property: 'customerId', type: 'string'),
                    new OA\Property(property: 'date', type: 'string'),
                    new OA\Property(property: 'statusName', type: 'string'),
                    new OA\Property(property: 'customersName', type: 'string', nullable: true),
                    new OA\Property(property: 'userComment', type: 'string', nullable: true),
                    new OA\Property(property: 'productDto', type: 'object'),
                ]
            )),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
            new OA\Response(response: 404, description: 'Не найдено'),
            new OA\Response(response: 422, description: 'Ошибка валидации'),
        ]
    )]
    public function update(UpdateOrderApiRequest $request)
    {
        $order = Order::findOrFail($request->id);

        $order->update([
            'executor_id' => $request->executorId,
            'status_order_id' => $request->statusOrderId,
            'customers_comment' => $request->customersComment,
            'user_comment' => $request->userComment,
        ]);

        return new OrderApiResource($order->fresh());
    }
}
