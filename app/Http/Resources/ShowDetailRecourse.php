<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ShowDetailRecourse',
    type: 'object',
    properties: [
        new OA\Property(property: 'eventId', type: 'integer', description: 'Идентификатор события'),
        new OA\Property(property: 'showId', type: 'integer', description: 'Идентификатор мероприятия'),
        new OA\Property(property: 'date', type: 'date', description: 'Дата события'),
    ]
)]
class ShowDetailRecourse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'eventId' => $this->id,
            'showId' => $this->showId,
            'date' => $this->date,
        ];
    }
}
