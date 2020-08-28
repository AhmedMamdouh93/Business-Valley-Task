<?php

namespace App\Hotels\Providers;

use App\Hotels\Hotel;
use App\Hotels\Apis\BestHotelsApi;
use App\Hotels\HotelProvidersInterface;

class BestHotelProvider implements HotelProvidersInterface
{

public function getMany($from,$to,$cityIataCode,$numberOfAdults)
{
    // We're not using any of this function paramaters because filtering
    //  the data will be the responsibility of the real api
    // if we want real filter we can use pipeline or filter normally on hotel collection
    $hotelsData = collect(readJsonFile('BestHotelsApi','hotels'));
    $hotels = array();
    foreach ($hotelsData as $hotelData) {
        $hotels[] = new Hotel
            (
                $hotelData['hotel'],
                'BestHotels',
                $hotelData['hotelFare'],
                explode(',', $hotelData['roomAmenities']),
                $hotelData['hotelRate']
            );   
    }
        return $hotels;
    }
}
