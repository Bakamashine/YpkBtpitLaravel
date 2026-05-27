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
        summary: 'Get all feedbacks',
        security: [['bearerAuth' => []]],
        tags: ['Feedback'],
        responses: [
            new OA\Response(response: 200, description: 'Success', content: new OA\JsonContent(
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
        summary: 'Get feedback by ID',
        security: [['bearerAuth' => []]],
        tags: ['Feedback'],
        parameters: [
            new OA\Parameter(name: 'feedback', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Success', content: new OA\JsonContent(
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
            new OA\Response(response: 404, description: 'Feedback not found', content: new OA\JsonContent(properties: [
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
        summary: 'Create feedback',
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
        tags: ['Feedback'],
        responses: [
            new OA\Response(response: 200, description: 'Created', content: new OA\JsonContent(properties: [])),
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
        summary: 'Update feedback by ID',
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
        tags: ['Feedback'],
        responses: [
            new OA\Response(response: 204, description: 'Updated', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 404, description: 'Feedback not found', content: new OA\JsonContent(properties: [
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
        summary: 'Delete feedback by ID',
        security: [['bearerAuth' => []]],
        tags: ['Feedback'],
        parameters: [
            new OA\Parameter(name: 'feedback', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Deleted', content: new OA\JsonContent(properties: [])),
            new OA\Response(response: 404, description: 'Feedback not found', content: new OA\JsonContent(properties: [
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
