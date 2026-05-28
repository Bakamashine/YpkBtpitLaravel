<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApiFeedbackRequest;
use App\Http\Requests\UpdateApiFeedbackRequest;
use App\Http\Resources\FeedbackCollection;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use OpenApi\Attributes as OA;


class FeedbackController extends Controller
{

    #[OA\Get(
        path: '/api/feedback/all',
        summary: 'Получить все отзывы',
        security: [['bearerAuth' => []]],
        tags: ['Отзывы'],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'comment', type: 'string'),
                    new OA\Property(property: 'raiting', type: 'integer'),
                    new OA\Property(property: 'user', properties: [
                        new OA\Property(property: 'id', type: 'string'),
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'phoneNumber', type: 'string'),
                        new OA\Property(property: 'userInfo', type: 'string'),
                        new OA\Property(property: 'avatarUrl', type: 'string', nullable: true),
                    ], type: 'object'),
                    new OA\Property(property: 'ypk', properties: [
                        new OA\Property(property: 'id', type: 'string'),
                        new OA\Property(property: 'ypkName', type: 'string'),
                        new OA\Property(property: 'description', type: 'string'),
                        new OA\Property(property: 'isActive', type: 'boolean'),
                    ], type: 'object'),
                ])
            )),
        ]
    )]
    public function getAll()
    {
        return FeedbackCollection::make(Feedback::all());
    }


    #[OA\Get(
        path: '/api/feedback/{feedback}',
        summary: 'Получить отзыв по ID',
        security: [['bearerAuth' => []]],
        tags: ['Отзывы'],
        parameters: [
            new OA\Parameter(name: 'feedback', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Успешно', content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'comment', type: 'string'),
                    new OA\Property(property: 'raiting', type: 'integer'),
                    new OA\Property(property: 'user', properties: [
                        new OA\Property(property: 'id', type: 'string'),
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'phoneNumber', type: 'string'),
                        new OA\Property(property: 'userInfo', type: 'string'),
                        new OA\Property(property: 'avatarUrl', type: 'string', nullable: true),
                    ], type: 'object'),
                    new OA\Property(property: 'ypk', properties: [
                        new OA\Property(property: 'id', type: 'string'),
                        new OA\Property(property: 'ypkName', type: 'string'),
                        new OA\Property(property: 'description', type: 'string'),
                        new OA\Property(property: 'isActive', type: 'boolean'),
                    ], type: 'object'),
                ]
            )),
            new OA\Response(response: 404, description: 'Отзыв не найден', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function getById(Feedback $feedback)
    {
        return FeedbackResource::make($feedback);
    }

    #[OA\Post(
        path: '/api/feedback',
        summary: 'Создать отзыв',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'comment', type: 'string'),
                    new OA\Property(property: 'raiting', type: 'integer', minimum: 1, maximum: 5),
                ]
            )
        ),
        tags: ['Отзывы'],
        responses: [
            new OA\Response(response: 200, description: 'Создано', content: new OA\JsonContent(properties: [])),
        ]
    )]
    public function store(StoreApiFeedbackRequest $request)
    {
        $request->user()->feedbacks()->create([
            "comment" => $request->comment,
            "rating" => $request->raiting
        ]);
        return response(status: 200);
    }

    #[OA\Put(
        path: '/api/feedback/update',
        summary: 'Обновить отзыв по ID',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'id', type: 'string'),
                    new OA\Property(property: 'comment', type: 'string'),
                    new OA\Property(property: 'raiting', type: 'integer', minimum: 1, maximum: 5),
                ]
            )
        ),
        tags: ['Отзывы'],
        responses: [
            new OA\Response(response: 204, description: 'Обновлено', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 404, description: 'Отзыв не найден', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function update(UpdateApiFeedbackRequest $request)
    {
        /** @var Feedback $current_feedback */
        $current_feedback = Feedback::findOrFail($request->id);
        $current_feedback->comment = $request->comment;
        $current_feedback->rating = $request->raiting;

        $current_feedback->save();
        return response(status: 204);
    }

    #[OA\Delete(
        path: '/api/feedback/{feedback}',
        summary: 'Удалить отзыв по ID',
        security: [['bearerAuth' => []]],
        tags: ['Отзывы'],
        parameters: [
            new OA\Parameter(name: 'feedback', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Удалено', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 404, description: 'Отзыв не найден', content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string'),
            ])),
        ]
    )]
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return response(status: 200);
    }


}
