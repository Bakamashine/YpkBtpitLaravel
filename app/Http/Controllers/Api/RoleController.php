<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use OpenApi\Attributes as OA;

class RoleController extends Controller
{
    #[OA\Get(
        path: '/api/role/all',
        summary: 'Получить все роли',
        security: [['bearerAuth' => []]],
        tags: ['Роли'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'name', type: 'string'),
                ])
            )),
        ]
    )]
    public function getAll() {
        return new RoleCollection(Role::all());
    }

    #[OA\Get(
        path: '/api/role/{role}',
        summary: 'Получить роль по ID',
        security: [['bearerAuth' => []]],
        tags: ['Роли'],
        parameters: [
            new OA\Parameter(name: 'role', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'name', type: 'string'),
                ]
            )),
            new OA\Response(response: 404, description: 'Роль не найдена', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function getById(Role $role) {
        return new RoleResource($role);
    }
}
