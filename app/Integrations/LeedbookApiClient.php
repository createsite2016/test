<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Http;
use App\Integrations\LeedBookApiInterface;

class LeedBookApiClient implements LeedBookApiInterface
{
    public function __construct(private string $baseUrl){}

    public function getShows(): array
    {
        $response = Http::get($this->baseUrl . '/shows');

        if ($response->successful()) {
            $data = $response->json('response') ?? [];

            return array_map(fn($item) => (object) [
                'id' => $item['id'] ?? null,
                'name' => $item['name'] ?? null,
            ], $data);
        }

        throw new \Exception('Не удалось получить мероприятия');
    }

    public function getDetailShow(int $showId): array
    {
        $url = $this->baseUrl . '/shows/' . $showId . '/events';

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json('response') ?? [];

            return array_map(fn($item) => (object) [
                'id' => $item['id'] ?? null,
                'showId' => $item['showId'] ?? null,
                'date' => $item['date'] ?? null,
            ], $data);
        } else {
            throw new \Exception('Не удалось получить мероприятие');
        }
    }

    public function getDetailEvent(int $eventId): array
    {
        $url = $this->baseUrl . '/events/' . $eventId . '/places';

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json('response') ?? [];

            return array_map(fn($item) => (object) [
                'id' => $item['id'] ?? null,
                'x' => $item['x'] ?? null,
                'y' => $item['y'] ?? null,
                'width' => $item['width'] ?? null,
                'height' => $item['height'] ?? null,
                'is_available' => $item['is_available'] ?? null,
            ], $data);
        } else {
            throw new \Exception('Не удалось получить событие');
        }
    }

    public function reserve(array $data): array
    {
        $url = $this->baseUrl . '/events/' . $data['eventId'] . '/reserve';

        $response = Http::post($url, [
            'name' => $data['name'],
            'places' => $data['places']
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception('Ошибка при бронировании');
        }
    }
}
