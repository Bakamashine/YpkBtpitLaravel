<?php

namespace App\Http\Controllers\Api;

use App\Contracts\IImageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApiUserRequest;
use App\Http\Requests\UpdateApiAdminUserRequest;
use App\Http\Requests\UpdateApiCurrentUserRequest;
use App\Http\Requests\UpdateApiUserRequest;
use App\Http\Resources\MeResource;
use App\Http\Resources\UserApiCollection;
use App\Http\Resources\UserApiResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes as OA;

class UserController extends Controller
{

    public function __construct(private IImageService $imageService)
    {
    }

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
    public function me(Request $request)
    {
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
    public function meAll(Request $request)
    {
        return UserResource::make($request->user());
    }

    #[OA\Get(
        path: '/api/user/all',
        summary: 'Получить всех пользователей',
        security: [['bearerAuth' => []]],
        tags: ['Пользователь'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'users', type: 'array', items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id', type: 'string'),
                            new OA\Property(property: 'fullName', type: 'string'),
                            new OA\Property(property: 'phoneNumber', type: 'string'),
                            new OA\Property(property: 'userInfo', type: 'string'),
                            new OA\Property(property: 'isActive', type: 'boolean'),
                            new OA\Property(property: 'avatarUrl', type: 'string', nullable: true),
                        ]
                    )),
                ]
            )),
            new OA\Response(response: 403, description: 'Доступ запрещён'),
        ]
    )]
    public function getAll()
    {
        return new UserApiCollection(User::all());
    }

    #[OA\Get(
        path: '/api/user/{user}',
        summary: 'Получить пользователя по ID',
        security: [['bearerAuth' => []]],
        tags: ['Пользователь'],
        parameters: [
            new OA\Parameter(name: 'user', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'fullName', type: 'string'),
                    new OA\Property(property: 'phoneNumber', type: 'string'),
                    new OA\Property(property: 'userInfo', type: 'string'),
                    new OA\Property(property: 'isActive', type: 'boolean'),
                    new OA\Property(property: 'avatarUrl', type: 'string', nullable: true),
                    new OA\Property(property: 'role', type: 'object'),
                    new OA\Property(property: 'ypk', type: 'object', nullable: true),
                ]
            )),
            new OA\Response(response: 404, description: 'Не найдено'),
        ]
    )]
    public function getById(User $user)
    {
        return new UserApiResource($user);
    }

    #[OA\Delete(
        path: '/api/user/{user}',
        summary: 'Удалить пользователя',
        security: [['bearerAuth' => []]],
        tags: ['Пользователь'],
        parameters: [
            new OA\Parameter(name: 'user', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Удалено'),
            new OA\Response(response: 404, description: 'Не найдено'),
        ]
    )]
    public function destroy(User $user)
    {
        $user->delete();
        return response(status: 204);
    }

    #[OA\Post(
        path: '/api/user',
        summary: 'Создать пользователя',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'Fullname', type: 'string'),
                        new OA\Property(property: 'Password', type: 'string'),
                        new OA\Property(property: 'PhoneNumber', type: 'string'),
                        new OA\Property(property: 'UserInfo', type: 'string', nullable: true),
                        new OA\Property(property: 'RoleId', type: 'string'),
                        new OA\Property(property: 'Avatar', type: 'string', format: 'binary', nullable: true),
                    ]
                )
            )
        ),
        tags: ['Пользователь'],
        responses: [
            new OA\Response(response: 201, description: 'Создано', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 422, description: 'Ошибка валидации', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string'),
                    new OA\Property(property: 'errors', type: 'object'),
                ]
            )),
        ]
    )]
    public function create(StoreApiUserRequest $request)
    {
        User::create([
            'name' => $request->Fullname,
            'password' => bcrypt($request->Password),
            'phone_number' => $request->PhoneNumber,
            'user_info' => $request->UserInfo,
            'avatar' => $request->hasFile("Avatar")
                ? $this->imageService->uploadImage($request->file('Avatar'), 'avatars')
                : null,
            'role_id' => $request->RoleId
        ]);

        return response(status: 201);
    }

    #[OA\Put(
        path: '/api/user',
        summary: 'Обновить пользователя по ID',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'Id', type: 'string'),
                        new OA\Property(property: 'OldPassword', type: 'string'),
                        new OA\Property(property: 'Password', type: 'string'),
                        new OA\Property(property: 'Fullname', type: 'string'),
                        new OA\Property(property: 'PhoneNumber', type: 'string'),
                        new OA\Property(property: 'UserInfo', type: 'string', nullable: true),
                        new OA\Property(property: 'RoleId', type: 'string'),
                        new OA\Property(property: 'Avatar', type: 'string', format: 'binary', nullable: true),
                    ]
                )
            )
        ),
        tags: ['Пользователь'],
        responses: [
            new OA\Response(response: 204, description: 'Обновлено'),
            new OA\Response(response: 401, description: 'Неверный пароль', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string'),
                ]
            )),
            new OA\Response(response: 404, description: 'Не найдено', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string'),
                ]
            )),
            new OA\Response(response: 422, description: 'Ошибка валидации', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string'),
                    new OA\Property(property: 'errors', type: 'object'),
                ]
            )),
        ]
    )]
    public function updateUser(UpdateApiUserRequest $request)
    {
        $user = User::findOrFail($request->Id);
        if (Hash::check($request->OldPassword, $user->password)) {

            $user->update([
                'name' => $request->Fullname,
                'password' => bcrypt($request->NewPassword),
                'phone_number' => $request->PhoneNumber,
                'user_info' => $request->UserInfo,
                'avatar' => $request->hasFile("Avatar")
                    ? $this
                        ->imageService
                        ->updateImage($request->file('Avatar'), 'avatars', $request->avatar)
                    : null,
                'role_id' => $request->RoleId
            ]);
            $user->save();

            return response(status: 204);
        }
        return response(status: 401);
    }

    #[OA\Put(
        path: '/api/user/current',
        summary: 'Обновить данные текущего пользователя',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'Fullname', type: 'string'),
                        new OA\Property(property: 'PhoneNumber', type: 'string'),
                        new OA\Property(property: 'UserInfo', type: 'string', nullable: true),
                        new OA\Property(property: 'Avatar', type: 'string', format: 'binary', nullable: true),
                    ]
                )
            )
        ),
        tags: ['Пользователь'],
        responses: [
            new OA\Response(response: 204, description: 'Обновлено'),
            new OA\Response(response: 422, description: 'Ошибка валидации', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string'),
                    new OA\Property(property: 'errors', type: 'object'),
                ]
            )),
        ]
    )]
    public function updateCurrentUser(UpdateApiCurrentUserRequest $request)
    {
        $current_user = $request->user();
        $current_user->update([
            'name' => $request->Fullname,
            'phone_number' => $request->PhoneNumber,
            'user_info' => $request->UserInfo,
            'avatar' => $request->hasFile("Avatar")
                ? $this
                    ->imageService
                    ->updateImage($request->file('Avatar'), 'avatars', $request->avatar)
                : null,
        ]);
        $current_user->save();

        return response(status: 204);
    }

    #[OA\Put(
        path: '/api/user/admin',
        summary: 'Обновить пользователя (администратор)',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'Id', type: 'string'),
                        new OA\Property(property: 'Fullname', type: 'string'),
                        new OA\Property(property: 'Password', type: 'string'),
                        new OA\Property(property: 'PhoneNumber', type: 'string'),
                        new OA\Property(property: 'UserInfo', type: 'string', nullable: true),
                        new OA\Property(property: 'RoleId', type: 'string'),
                        new OA\Property(property: 'Avatar', type: 'string', format: 'binary', nullable: true),
                    ]
                )
            )
        ),
        tags: ['Пользователь'],
        responses: [
            new OA\Response(response: 204, description: 'Обновлено'),
            new OA\Response(response: 401, description: 'Неверный пароль', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string'),
                ]
            )),
            new OA\Response(response: 404, description: 'Не найдено', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string'),
                ]
            )),
            new OA\Response(response: 422, description: 'Ошибка валидации', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'message', type: 'string'),
                    new OA\Property(property: 'errors', type: 'object'),
                ]
            )),
        ]
    )]
    public function updateUserForAdmin(UpdateApiAdminUserRequest $request)
    {
        $user = User::findOrFail($request->Id);
        if (Hash::check($request->OldPassword, $user->password)) {

            $user->update([
                'name' => $request->Fullname,
                'phone_number' => $request->PhoneNumber,
                'user_info' => $request->UserInfo,
                'avatar' => $request->hasFile("Avatar")
                    ? $this
                        ->imageService
                        ->updateImage($request->file('Avatar'), 'avatars', $request->avatar)
                    : null,
                'role_id' => $request->RoleId]);
            $user->save();

            return response(status: 204);
        }
        return response(status: 401);
    }

}
