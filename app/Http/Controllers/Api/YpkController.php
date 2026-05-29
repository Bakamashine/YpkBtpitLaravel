<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreYpkApiRequest;
use App\Http\Requests\UpdateYpkApiRequest;
use App\Http\Resources\YpkCollection;
use App\Http\Resources\YpkResource;
use App\Models\Ypk;
use OpenApi\Attributes as OA;

class YpkController extends Controller
{
    #[OA\Get(
        path: '/api/ypk/all',
        summary: 'Получить все YPK',
        security: [['bearerAuth' => []]],
        tags: ['YPK'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'ypkName', type: 'string'),
                    new OA\Property(property: 'description', type: 'string'),
                    new OA\Property(property: 'isActive', type: 'boolean'),
                ])
            )),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
        ]
    )]
    public function getAll()
    {
        return new YpkCollection(Ypk::all());
    }

    #[OA\Get(
        path: '/api/ypk/{ypk}',
        summary: 'Получить YPK по ID',
        security: [['bearerAuth' => []]],
        tags: ['YPK'],
        parameters: [
            new OA\Parameter(name: 'ypk', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'ypkName', type: 'string'),
                    new OA\Property(property: 'description', type: 'string'),
                    new OA\Property(property: 'isActive', type: 'boolean'),
                ]
            )),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
            new OA\Response(response: 404, description: 'Не найдено'),
        ]
    )]
    public function getById(Ypk $ypk)
    {
        return new YpkResource($ypk);
    }

    #[OA\Delete(
        path: '/api/ypk/{id}',
        summary: 'Удалить YPK',
        security: [['bearerAuth' => []]],
        tags: ['YPK'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Удалено'),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
            new OA\Response(response: 404, description: 'Не найдено'),
        ]
    )]
    public function destroy(Ypk $ypk)
    {
        $ypk->delete();
        return response(status: 204);
    }

    #[OA\Post(
        path: '/api/ypk',
        summary: 'Создать YPK',
        security: [['bearerAuth' => []]],
        tags: ['YPK'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'ypkName', type: 'string'),
                    new OA\Property(property: 'description', type: 'string'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Создано'),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
            new OA\Response(response: 422, description: 'Ошибка валидации'),
        ]
    )]
    public function store(StoreYpkApiRequest $request)
    {
        Ypk::create([
            'ypk_name' => $request->ypkName,
            'description' => $request->description
        ]);

        return response(status: 201);
    }

    #[OA\Put(
        path: '/api/ypk',
        summary: 'Обновить YPK',
        security: [['bearerAuth' => []]],
        tags: ['YPK'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'ypkName', type: 'string'),
                    new OA\Property(property: 'description', type: 'string'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 204, description: 'Обновлено'),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
            new OA\Response(response: 404, description: 'Не найдено'),
            new OA\Response(response: 422, description: 'Ошибка валидации'),
        ]
    )]
    public function update(UpdateYpkApiRequest $request)
    {
        $ypk = Ypk::find($request->id);
        $ypk->update([
            'ypk_name' => $request->ypkName,
            'description' => $request->description
        ]);

        return response(status: 204);
    }
}
