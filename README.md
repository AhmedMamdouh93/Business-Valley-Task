<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Requirements

The project is based on the version 7.x of the Laravel framework, so make sure that you are satisfying the requirements listed in the framework's documentation


## Installation

1- Clone the repository

2- composer install

3- cp .env.example .env

4- php artisan key:generate

5- php artisan serve

6- run url localhost:8000/api/hotel-search?date_from=2020-08-25&date_to=2020-08-31&city_code=CAI&adults_number=2

7- to run unit test .\vendor\bin\phpunit






Challenge details:  
OurHotels is a hotel search solution that looks into many providers and displays results from all the available hotels, for now, we are aggregate from two providers: BestHotels and  TopHotel.

What is required:
Implement OurHotels service that should return results from both providers (BestHotels and TopHotel), the result should be a JSON response with a valid HTTP status code of all available hotels ordered by hotel rate.
OurHotels API (the aggregator API which you are going to build):Request:
    - from_date: ISO_LOCAL_DATE
    - to_date: ISO_LOCAL_DATE
    - city:  IATA code (AUH)
    - adults_ number: integer number
Response:
    - provider: name of the provider (BestHotels or TopHotels)
    - hotelName: Name of the hotel
    - fare: fare per night
    - amenities: array of strings
Providers API details:BestHotel  API:
Request:
     - fromDate  ISO_LOCAL_DATE
     - toDate   ISO_LOCAL_DATE
     - city  IATA code (AUH)
     - numberOfAdults: integer number
Response:
     - hotel: Name of the hotel
      - hotelRate: Number from 1-5
      - hotelFare: Total price rounded to 2 decimals
      - roomAmenities: String of amenities separated by comma 

TopHotels API: Request:
     - from  ISO_INSTANT
     - To  ISO_INSTANT
     - city:  IATA code (AUH)
     - adultsCount: integer number
Response:
     - hotelName: Name of the hotel
     - rate: String of '*' (from 1 to 5)
     - price: Price of the hotel per night
     - discount: discount on the room (if available).
     - amenities: array of strings.

 What you need to implement:
= A solution that meets the above requirements.
= You should consider the scalability in your solution, which means if we are going to add a new provider in the future, that should apply in a minimum of changes and without affecting the current integration providers.
= a ready to integrate push notification service if a new hotel is added.
