<?php

namespace App\Hotels;

interface HotelProvidersInterface
{
    public function getMany($date_from, $date_to, $city_code, $number_of_adults);
}
