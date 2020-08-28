<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotels\HotelsService;
use App\Http\Resources\HotelResource;
use App\Http\Requests\SearchRequest;
use App\Http\Controllers\ApiController;

class HotelController extends ApiController
{

    public function __construct(HotelsService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function search(SearchRequest $request)
    {
        $data = $request->all();
        return $this->respond(
            HotelResource::collection(
                $this->hotelService->search(
                    $data['date_from'],
                    $data['date_to'],
                    $data['city_code'],
                    $data['adults_number']
                )
            )
        ); 
    }


    public function insertHotel(){
        // this is dummy example for adding new object to tophotelapi json file
        // here we get data inside json file
        $hotelsData = collect(readJsonFile('TopHotelsApi','hotels'));
        // adding new dummy object to collection
        $hotelsData->push([
            "hotelName"=>'Ramses Hilton',"rate"=>"****",
            "price"=>3333,"amentities"=>["Free Wife","Pool"],
            "provider"=>"TopHotelsApi"
        ]);
        $data['hotels'] = $hotelsData;
        $jsonData = json_encode($data);
        // re write json file with updated data
        file_put_contents(storage_path() . "/jsonfiles/TopHotelsApi.json", $jsonData);
        
        // notify any user $user->notify(new NewHotelAddedNotification) every user have fcm_token
        return $this->respond(HotelResource::collection($jsonData));
       
    }
}
