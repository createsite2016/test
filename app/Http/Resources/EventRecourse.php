<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'EventRecourse',
    type: 'object',
    properties: [
        new OA\Property(property: 'placeId', type: 'integer', description: 'Идентификатор места'),
        new OA\Property(property: 'x', type: 'integer', description: 'Горизонтальная координата ряда'),
        new OA\Property(property: 'y', type: 'integer', description: 'Вертикальная координата ряда'),
        new OA\Property(property: 'width', type: 'integer', description: 'Ширина места'),
        new OA\Property(property: 'height', type: 'integer', description: 'Длина места'),
        new OA\Property(property: 'is_available', type: 'boolean', description: 'Место свободно для бронирования'),
    ]
)]
class EventRecourse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'placeId' => $this->id,
            'x' => $this->x,
            'y' => $this->y,
            'width' => $this->width,
            'height' => $this->height,
            'is_available' => $this->is_available
        ];
    }
}
