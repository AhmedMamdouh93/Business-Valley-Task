<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Hotels\Providers\TopHotelProvider;
class TopHotelProviderTest extends TestCase
{
    
    /** @test */
    public function test_it_returns_valid_top_hotels_data()
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


        $provider = $this->app->make(TopHotelProvider::class);
        $hotels = collect($provider->getMany('2020-09-01', '2020-09-30', 'ANY', 4));
        $this->assertCount(2, $hotels);


        $this->assertEquals("6225", $hotels->first()['fare']);
        $this->assertEquals("Al Alamein Hotel", $hotels->first()['name']);
        $this->assertEquals("4.9", $hotels->first()['rate']);
        $this->assertEquals("TopHotels", $hotels->first()['provider']);
        $this->assertEquals(["Free Wifi","Free parking"],$hotels->first()['amenities']);
        

        $this->assertEquals("1223", $hotels->last()['fare']);
        $this->assertEquals("Sheraton Montazah Hotel", $hotels->last()['name']);
        $this->assertEquals("4.3", $hotels->last()['rate']);
        $this->assertEquals("TopHotels", $hotels->last()["provider"]);
        $this->assertEquals(["Free Wifi","Pool","Taking safety measures"],$hotels->last()['amenities']);


     
    }
}
