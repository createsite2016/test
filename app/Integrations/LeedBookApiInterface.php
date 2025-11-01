<?php

namespace App\Integrations;

use App\Dto\ShowData;

interface LeedBookApiInterface
{
    public function getShows(): array;
    public function getDetailEvent(int $eventId): array;
    public function getDetailShow(int $id): array;
    public function reserve(array $data): array;
}
