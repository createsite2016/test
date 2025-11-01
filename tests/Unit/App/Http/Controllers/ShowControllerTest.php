<?php

namespace Tests\Unit\App\Http\Controllers;

use App\Integrations\LeedBookApiInterface;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    public function test_show_endpoint_returns_detail_show_data()
    {
        $mockData = [
            (object) [
                'id' => 101,
                'showId' => 5,
                'date' => '2025-12-01',
            ],
            (object) [
                'id' => 102,
                'showId' => 5,
                'date' => '2025-12-02',
            ],
        ];

        $mockApi = $this->createMock(LeedBookApiInterface::class);
        $mockApi->expects($this->once())
                ->method('getDetailShow')
                ->with(5)
                ->willReturn($mockData);

        $this->app->instance(LeedBookApiInterface::class, $mockApi);

        $response = $this->getJson('/api/shows/5');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                             'eventId',
                             'showId',
                             'date',
                         ],
                     ],
                 ])
                 ->assertJson([
                     'data' => [
                         [
                             'eventId' => 101,
                             'showId' => 5,
                             'date' => '2025-12-01',
                         ],
                         [
                             'eventId' => 102,
                             'showId' => 5,
                             'date' => '2025-12-02',
                         ],
                     ],
                 ]);
    }
}
