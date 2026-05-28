<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatusOrderCollection;
use App\Http\Resources\StatusOrderResource;
use App\Models\StatusOrder;
use OpenApi\Attributes as OA;

class StatusOrderController extends Controller
{
    #[OA\Get(
        path: '/api/StatusOrder/all',
        summary: 'Получить все статусы заказов',
        security: [['bearerAuth' => []]],
        tags: ['Статусы заказов'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'statusName', type: 'string'),
                ])
            )),
        ]
    )]
    public function getAll()
    {
        return new StatusOrderCollection(StatusOrder::all());
    }

    #[OA\Get(
        path: '/api/StatusOrder/{statusOrder}',
        summary: 'Получить статус заказа по ID',
        security: [['bearerAuth' => []]],
        tags: ['Статусы заказов'],
        parameters: [
            new OA\Parameter(name: 'statusOrder', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'statusName', type: 'string'),
                ]
            )),
            new OA\Response(response: 404, description: 'Статус заказа не найден', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function getById(StatusOrder $statusOrder)
    {
        return new StatusOrderResource($statusOrder);
    }
}
