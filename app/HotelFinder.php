<?php

namespace App;

require_once 'Helper.php';
require_once 'models/Hotel.php';

use App\Helper;
use Models\Hotel;

class HotelFinder
{
    static function findHotels($destination, $checkin, $checkout, $guests)
    {
        $url = 'https://beta.id90travel.com/api/v1/hotels.json';
        $data = [
            'guests[]' => $guests,
            'checkin' => date('Y-m-d', strtotime($checkin)),
            'checkout' => date('Y-m-d', strtotime($checkout)),
            'destination' => $destination,
            'keyword' => '',
            'rooms' => '1',
            'longitude' => '',
            'latitude' => '',
            'sort_criteria' => 'Overall',
            'sort_order' => 'desc',
            'per_page' => '25',
            'page' => '1',
            'currency' => 'USD',
            'price_low' => '',
            'price_high' => ''
        ];
        $options = [
            'http' => [
                'header' => 'Content-Type: application/json',
                'method' => 'GET'
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url.'?'.http_build_query($data), false, $context);
        $json = json_decode($response);

        $hotels = array();
        
        foreach ($json->hotels as $hotel) {
            array_push($hotels, new Hotel($hotel));
        }

        return $hotels;
    }

}
