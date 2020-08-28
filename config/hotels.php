<?php

return [
    // Here we specify any provider we used to get hotels and all must implement HotelProvidersInterface
    'providers' => [
        \App\Hotels\Providers\BestHotelProvider::class,
        \App\Hotels\Providers\TopHotelProvider::class,
    ],
];
