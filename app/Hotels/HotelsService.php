<?php

namespace App\Hotels;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use App\Hotels\HotelProvidersInterface;

class HotelsService
{
    private $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    // Here we get all providers data after filtering it according to parameters and merge them in one collection
    public function search($fromDate,$toDate,$city,$adultsNumber)
    {
        $all_providers_results = collect([]);

        // Looping through available hotel providers
        foreach (config('hotels.providers') as $provider) {
            $provider = $this->container->make($provider);

            // in case incoming providers in hotels.providers not implementing interface
            if (!$provider instanceof HotelProvidersInterface) {
                $format = 'The configured provider %s must implement %s interface.';
                throw new Exception(sprintf($format,get_class($provider) ,HotelProvidersInterface::class));
            }

            // (concat) used for merging provider's hotels in providers collection 
            $all_providers_results = $all_providers_results->concat(
                $provider->getMany($fromDate, $toDate, $city, $adultsNumber)
            );
        }
        // Order hotels by rate desc
        return $all_providers_results->sortByDesc(function ($hotel) {
            return $hotel->rate;
        })->values();
    }
}
