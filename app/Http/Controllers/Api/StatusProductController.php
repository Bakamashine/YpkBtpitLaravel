<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatusProductCollection;
use App\Http\Resources\StatusProductResource;
use App\Models\StatusProduct;
use OpenApi\Attributes as OA;

class StatusProductController extends Controller
{
    #[OA\Get(
        path: '/api/StatusProduct/all',
        summary: 'Получить все статусы товаров',
        security: [['bearerAuth' => []]],
        tags: ['Статусы товаров'],
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
        return new StatusProductCollection(StatusProduct::all());
    }

    #[OA\Get(
        path: '/api/StatusProduct/{statusProduct}',
        summary: 'Получить статус товара по ID',
        security: [['bearerAuth' => []]],
        tags: ['Статусы товаров'],
        parameters: [
            new OA\Parameter(name: 'statusProduct', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'statusName', type: 'string'),
                ]
            )),
            new OA\Response(response: 404, description: 'Статус товара не найден', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function getById(StatusProduct $statusProduct)
    {
        return new StatusProductResource($statusProduct);
    }
}
