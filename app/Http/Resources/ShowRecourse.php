<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ShowRecourse',
    type: 'object',
    properties: [
        new OA\Property(property: 'showId', type: 'integer', description: 'Идентификатор мероприятия'),
        new OA\Property(property: 'name', type: 'string', description: 'Название мероприятия'),
    ]
)]
class ShowRecourse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'showId' => $this->id,
            'name' => $this->name,
        ];
    }
}
