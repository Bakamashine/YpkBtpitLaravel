<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApiFavouriteRequest;
use App\Http\Resources\FavouriteCollection;
use App\Models\Favourite;
use OpenApi\Attributes as OA;

class FavouriteController extends Controller
{
    #[OA\Get(
        path: '/api/favourite/all',
        summary: 'Получить все избранные',
        tags: ['Избранное'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'user_id', type: 'string'),
                    new OA\Property(property: 'product_id', type: 'string'),
                    new OA\Property(property: 'created_at', type: 'string', nullable: true),
                    new OA\Property(property: 'updated_at', type: 'string', nullable: true),
                ])
            )),
        ]
    )]
    public function getAll()
    {
        return new FavouriteCollection(Favourite::all());
    }

    #[OA\Delete(
        path: '/api/favourite/{favourite}',
        summary: 'Удалить избранное по ID',
        security: [['bearerAuth' => []]],
        tags: ['Избранное'],
        parameters: [
            new OA\Parameter(name: 'favourite', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Удалено', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 404, description: 'Избранное не найдено', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function destroy(Favourite $favourite)
    {
        $favourite->delete();
        return response(status: 204);
    }

    #[OA\Post(
        path: '/api/favourite',
        summary: 'Добавить в избранное',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'productId', type: 'string'),
                ]
            )
        ),
        tags: ['Избранное'],
        responses: [
            new OA\Response(response: 200, description: 'Создано', content: new OA\JsonContent(properties: [])),
        ]
    )]
    public function store(StoreApiFavouriteRequest $request)
    {
        $request->user()
            ->favourite()
            ->create([
                "product_id" => $request->productId
            ]);

        return response(status: 200);
    }
}
