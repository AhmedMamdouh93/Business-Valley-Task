<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Hotels\HotelsService;
use App\Hotels\Providers\TopHotelProvider;
use App\Hotels\Providers\BestHotelProvider;
class HotelServiceTest extends TestCase
{
    
    /** @test */
    public function testBasicTest()
    {

        // We have 10 result in  both top provider and best hotel provider
        // so it mocking results into 2 and 2 for testing
        $this->mock(TopHotelProvider::class, function ($mock) {
            $mock->shouldReceive('getMany')->once()
            ->andReturn([
                [
                    "name"=>"Al Alamein Hotel",
                    "rate"=>4.9,
                    "fare"=>6225,
                    "amenities"=>["Free Wifi","Free parking"],
                    "provider"=>'TopHotels'
                ],
                [
                    "name"=>"Sheraton Montazah Hotel",
                    "rate"=>4.3,
                    "fare"=>1223,
                    "amenities"=>["Free Wifi","Pool","Taking safety measures"],
                    "provider"=>"TopHotels"
                ]
            ]);
        });
        $this->mock(BestHotelProvider::class, function ($mock) {
            $mock->shouldReceive('getMany')->once()
                ->andReturn([
                    [
                        "provider"=> "BestHotels",
                        "name"=> "Jolie Ville Golf & Resort",
                        "fare"=> 1422,
                        "rate"=>4.6,
                        "amenities"=> [
                                "Airport shuttle",
                                "Car park",
                                "Room safe",
                                "Pool bar"
                        ]
                    ],
                    [
                        "provider"=> "BestHotels",
                        "name"=> "Hilton Marsa Alam Nubian Resort",
                        "rate"=>4.7,
                        "fare"=> 1833,
                        "amenities"=> [
                            "Beauty salon",
                            "Body treatments",
                            "WiFi in lobby",
                            "WiFi in rooms",
                            "Spa",
                            "Parking",
                            "Pool",
                            "Pets",
                            "A/C"
                        ]
                    ]
                ]);
        });


        $provider = $this->app->make(HotelsService::class);
        $hotels = collect($provider->search('2020-09-01', '2020-09-30', 'ANY', 4));
        // dd($hotels);
        $this->assertCount(4, $hotels);
        $this->assertEquals(
            [6225,1833,1422,1223],
            $hotels->map(function ($hotel) {
                return $hotel['fare'];
            })->toArray()
        );
        $this->assertEquals(
            [4.9,4.7,4.6,4.3],
            $hotels->map(function ($hotel) {
                return $hotel['rate'];
            })->toArray()
        );
        $this->assertEquals(
            ["TopHotels","BestHotels"],
            array_unique($hotels->map(function ($hotel) {
                return $hotel['provider'];
            })->toArray())
        );

        $this->assertEquals(
            [
                "Al Alamein Hotel",
                "Hilton Marsa Alam Nubian Resort",
                "Jolie Ville Golf & Resort",
                "Sheraton Montazah Hotel"
            ],
            array_unique($hotels->map(function ($hotel) {
                return $hotel['name'];
            })->toArray())
        );
    }
}
