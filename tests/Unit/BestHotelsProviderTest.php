<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Hotels\Providers\BestHotelProvider;
class BestHotelProviderTest extends TestCase
{
    
    /** @test */
    public function test_it_returns_valid_best_hotels_data()
    {
        // We have 10 result in  both top provider and best hotel provider
        // so it mocking results into 2 and 2 for testing
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
                            "Pets",
                            "A/C"
                        ]
                    ]
                ]);
        });


        $provider = $this->app->make(BestHotelProvider::class);
        $hotels = collect($provider->getMany('2020-09-01', '2020-09-30', 'ANY', 4));
        $this->assertCount(2, $hotels);

        $this->assertEquals("1422", $hotels->first()['fare']);
        $this->assertEquals("Jolie Ville Golf & Resort", $hotels->first()['name']);
        $this->assertEquals("4.6", $hotels->first()['rate']);
        $this->assertEquals("BestHotels", $hotels->first()['provider']);
        $this->assertEquals(["Airport shuttle","Car park","Room safe","Pool bar"],$hotels->first()['amenities']);
        
        $this->assertEquals("1833", $hotels->last()['fare']);
        $this->assertEquals("Hilton Marsa Alam Nubian Resort", $hotels->last()['name']);
        $this->assertEquals("4.7", $hotels->last()['rate']);
        $this->assertEquals("BestHotels", $hotels->last()["provider"]);
        $this->assertEquals(["Beauty salon","Body treatments","Pets","A/C"],$hotels->last()['amenities']);


     
    }
}
