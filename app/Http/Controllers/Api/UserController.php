<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\MeResource;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return MeResource
     */
    #[OA\Get(
        path: '/api/auth/me',
        summary: 'Получить информацию о текущем пользователе',
        security: [['bearerAuth' => []]],
        tags: ['Пользователь'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'phoneNumber', type: 'string'),
                    new OA\Property(property: 'email', type: 'string', nullable: true),
                    new OA\Property(property: 'role', type: 'string'),
                ]
            )),
        ]
    )]
    public function me(Request $request) {
        return MeResource::make($request->user());
    }

    #[OA\Get(
        path: '/api/auth/me/all',
        summary: 'Получить полную информацию о текущем пользователе',
        security: [['bearerAuth' => []]],
        tags: ['Пользователь'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'phoneNumber', type: 'string'),
                    new OA\Property(property: 'email', type: 'string', nullable: true),
                    new OA\Property(property: 'role', type: 'string'),
                    new OA\Property(property: 'userInfo', type: 'string'),
                    new OA\Property(property: 'avatarUrl', type: 'string', nullable: true),
                ]
            )),
        ]
    )]
    public function meAll(Request $request) {
        return UserResource::make($request->user());
    }
}
