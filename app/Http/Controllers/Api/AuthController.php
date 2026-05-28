<?php

namespace App\Http\Controllers\Api;

use App\Enums\TokenAbility;
use App\Http\Controllers\Controller;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\StoreApiLoginRequest;
use App\Http\Requests\StoreApiRegisterRequest;
use App\Models\User;
use OpenApi\Attributes as OA;

#[OA\Info(version: '1.0.0', description: 'Ypk btpit', title: 'Ypk btpit')]
#[OA\SecurityScheme(securityScheme: 'bearerAuth', type: 'http', bearerFormat: 'JWT', scheme: 'bearer')]
class AuthController extends Controller
{

    private function generateTokens(User $user)
    {
        $atExpireTime = now()->addMinutes(config('sanctum.expiration'));
        $rtExpireTime = now()->addMinutes(config('sanctum.rt_expiration'));

        $accessAbility = $user->isAdmin()
            ? TokenAbility::ADMIN_ACCESS
            : TokenAbility::USER_ACCESS;

        $accessToken = $user->createToken('access_token', [$accessAbility], $atExpireTime);
        $refreshToken = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN], $rtExpireTime);

        return response()->json([
            "accessToken" => $accessToken->plainTextToken,
            "refreshToken" => $refreshToken->plainTextToken
        ]);
    }

    #[OA\Post(
        path: '/api/auth/login',
        summary: 'Вход по номеру телефона и паролю',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'phoneNumber', type: 'string', example: '+79992222222'),
                    new OA\Property(property: 'password', type: 'string', example: 'password'),
                ]
            )
        ),
        tags: ['Авторизация'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'accessToken', type: 'string'),
                    new OA\Property(property: 'refreshToken', type: 'string'),
                ]
            )),
            new OA\Response(response: 401, description: 'Не авторизован', content: new OA\JsonContent(properties: [])),
        ]
    )]
    public function login(StoreApiLoginRequest $request)
    {
        /** @var User $found_user */
        $found_user = User::where('phone_number', $request->phoneNumber)->first();
        if ($found_user && \Hash::check($request->password, $found_user->password)) {
            return $this->generateTokens($found_user);
        }
        return response(status: 401);
    }

    #[OA\Post(
        path: '/api/auth/register',
        summary: 'Регистрация нового пользователя',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'fullName', type: 'string', example: 'John Doe'),
                    new OA\Property(property: 'phoneNumber', type: 'string', example: '+79001234567'),
                    new OA\Property(property: 'password', type: 'string', example: 'password'),
                ]
            )
        ),
        tags: ['Авторизация'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'accessToken', type: 'string'),
                    new OA\Property(property: 'refreshToken', type: 'string'),
                ]
            )),
        ]
    )]
    public function register(StoreApiRegisterRequest $request)
    {
        $created_user = User::create([
            'name' => $request->fullName,
            'phone_number' => $request->phoneNumber,
            'password' => bcrypt($request->password)
        ]);
        return $this->generateTokens($created_user);
    }

    #[OA\Post(
        path: '/api/auth/logout',
        summary: 'Выход и отзыв всех токенов',
        security: [['bearerAuth' => []]],
        tags: ['Авторизация'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(properties: [])),
        ]
    )]
    public function logout(RefreshTokenRequest $request)
    {
        $request->user()->tokens()->delete();
        return response(status: 200);
    }

    #[OA\Post(
        path: '/api/auth/loginViaToken',
        summary: 'Получить новые токены по refresh token',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'refreshToken', type: 'string', example: '...'),
                ]
            )
        ),
        tags: ['Авторизация'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'accessToken', type: 'string'),
                    new OA\Property(property: 'refreshToken', type: 'string'),
                ]
            )),
            new OA\Response(response: 401, description: 'Недействительный или просроченный refresh token', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function loginViaToken(RefreshTokenRequest $request)
    {
        $plainToken = $request->refreshToken;

        $token = \Laravel\Sanctum\PersonalAccessToken::findToken($plainToken);

        if (!$token
            || !$token->can(TokenAbility::ISSUE_ACCESS_TOKEN->value)
            || $token->expires_at?->isPast()
        ) {
            return response()->json(['message' => 'Invalid or expired refresh token'], 401);
        }

        $user = $token->tokenable;
        $token->delete();

        return $this->generateTokens($user);
    }
}
