<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowDetailRecourse;
use App\Http\Resources\ShowRecourse;
use App\Integrations\LeedBookApiInterface;
use OpenApi\Attributes as OA;

class ShowController extends Controller
{
    #[OA\Get(
        path: '/api/shows',
        tags: ['Shows'],
        description: 'Получение списка мероприятий',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список мероприятий',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: ShowRecourse::class
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function index(LeedBookApiInterface $api)
    {
        return ShowRecourse::collection($api->getShows());
    }

    #[OA\Get(
        path: '/api/shows/{showId}/',
        tags: ['Shows'],
        description: 'Получение детальной информации о мероприятии (список дат и ID событий)',
        parameters: [
            new OA\Parameter(
                name: 'showId',
                in: 'path',
                description: 'Идентификатор мероприятия',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Детальная информация о мероприятии',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: ShowDetailRecourse::class
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function show(int $showId, LeedBookApiInterface $api)
    {
        return ShowDetailRecourse::collection($api->getDetailShow($showId));
    }
}
