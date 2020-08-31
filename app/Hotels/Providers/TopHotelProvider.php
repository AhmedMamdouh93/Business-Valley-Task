<?php

namespace App\Hotels\Providers;

use App\Hotels\Hotel;
use App\Hotels\HotelProvidersInterface;

class TopHotelProvider implements HotelProvidersInterface
{

    
    public function getMany($from,$to,$cityIataCode,$numberOfAdults)
    {
        // We're not using any of this function paramaters because filtering
        //  the data will be the responsibility of the real api
        // if we want real filter we can use pipeline or filter normally on hotel collection
        $hotelsData = collect(readJsonFile('TopHotelsApi','hotels'));
        $hotels = array();
        foreach ($hotelsData as $hotelData) {
            $hotel = new Hotel
            (
                $hotelData['hotelName'],
                'TopHotels',
                $hotelData['price'],
                $hotelData['amenities'],
                strlen($hotelData['rate'])
            ); 
            if (isset($hotelData['discount'])) {
                $hotel->setHotelDiscount($hotelData['discount']);
            }
            $hotels[]=$hotel;
        }
        return $hotels;
    }

}
