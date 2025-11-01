<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReverseRequest;
use App\Http\Resources\EventRecourse;
use App\Integrations\LeedBookApiInterface;
use OpenApi\Attributes as OA;

class EventController extends Controller
{
    #[OA\Get(
        path: '/api/events/{eventId}/',
        tags: ['Events'],
        description: 'Получение детальной информации о событии (список мест)',
        parameters: [
            new OA\Parameter(
                name: 'eventId',
                in: 'path',
                description: 'Идентификатор события',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список событий',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: EventRecourse::class
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function show(int $eventId, LeedBookApiInterface $api)
    {
        return EventRecourse::collection($api->getDetailEvent($eventId));
    }

    public function reserve(int $eventId, LeedBookApiInterface $api, ReverseRequest $request)
    {
        $data = $request->validated();
        $data['eventId'] = $eventId;

        return $api->reserve($data);
    }
}
