<?php

namespace Models;

class Hotel
{
    public $name;
    public $city;
    public $capacity;
    public $pricePerNight;
    public $rate;

    function __construct()
    {
        $this->name = $this->getRandomName();
        $this->city = $this->getRandomCity();
        $this->capacity = $this->getRandomCapacity();
        $this->pricePerNight = $this->getRandomPricePerNight();
        $this->rate = $this->getRandomRate();
    }

    private function getRandomName()
    {
        $names = [
            'Nh Panorama',
            'Nh Urbano',
            'Holiday Inn Cordoba',
            'Interplaza Hotel',
            'Merit Gran Hotel Victoria',
            'Buen Pastor Capuchinos',
            'Caseros 248 Hotel',
            'Hotel Felipe II',
            'Kube Apartments',
            'Sussex',
            'Apartamento Flowers By Garden',
            'Babilonia Hostel'
        ];

        return $names[array_rand($names, 1)];
    }

    private function getRandomCity()
    {
        $cities = [
            'Córdoba',
            'Santiago de Chile',
            'Los Angeles',
            'Chipre',
            'Barcelona',
            'Las Varillas',
            'Rosario',
            'Brasilia',
            'Alta Gracia',
            'Madrid',
            'Berlin',
            'Bariloche'
        ];
        return $cities[array_rand($cities, 1)];

    }

    private function getRandomCapacity()
    {
      return mt_rand(5, 35);
    }

    private function getRandomPricePerNight()
    {
        return mt_rand(800, 1900);
    }

    private function getRandomRate()
    {
        $rate = (float)mt_rand(1, 5) + (mt_rand(0,9) / 10);
        $rate = $rate > 5 ? 5 : $rate;
        return $rate;
    }
}
