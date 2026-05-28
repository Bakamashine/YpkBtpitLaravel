<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repository\IOrderRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderApiRequest;
use App\Http\Resources\OrderApiCollection;
use App\Http\Resources\OrderApiResource;
use App\Models\Order;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class OrderController extends Controller
{

    public function __construct(private IOrderRepository $repository)
    {

    }

    #[OA\Get(
        path: '/api/order/for-manager',
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
    public function getById(Order $order)
    {
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
        $request->user()->orders([
            'product_id' => $request->productId,
            'user_comment' => $request->userComment,
            'customers_comment' => $request->customersComment
        ]);

        return response(status: 200);
    }
}
