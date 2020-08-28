<?php

namespace App\Hotels;

use Exception;

class Hotel
{
    public $name;
    public $provider;
    public $fare;
    public $amenities;
    public $rate;
    public $discount;

    public function __construct($name,$provider,$fare,$amenities,$rate)
    {
        $this->name = $name;
        $this->provider = $provider;
        $this->fare = $fare;
        $this->amenities = $amenities;
        $this->rate = $rate;
    }

    public function getHotelDiscount()
    {
        return $this->discount;
    }

    public function setHotelDiscount($discount)
    {
        if ($discount > 100 || $discount < 1) {
            throw new Exception('The discount is a percentage so it must be an integer between 1 and 100');
        }
        $this->discount = $discount;
        return $this;
    }
}
