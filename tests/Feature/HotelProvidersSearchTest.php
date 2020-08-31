<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelProvidersSearchTest extends TestCase
{
    public function setUp(): void{
        parent::setUp();
        $this->response =$this->get('api/hotel-search?date_from=2020-09-25&date_to=2020-09-30&city_code=TTT&adults_number=2');
    }

    /** @test */
    public function it_tests_that_it_gets_searched_hotels_From_all_providers()
    {
        // Assert that the response has status code 200
        $this->response->assertStatus(200)
            // Assert that the response has a given JSON structure:
        ->assertJsonStructure([
            '*' => [
                'provider',
                'hotelName',
                'fare',
                'amenities',
            ],
        ]);
    }
}
