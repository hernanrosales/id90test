<?php

namespace Models;

require_once 'Model.php';
require_once 'Member.php';

use Models\Model;
use Models\Member;

class Hotel extends Model
{
    const CURRENCY_ARS = '$';
    const CURRENCY_USD = 'U$D';

    public function getCity(): string
    {
        return $this->location['city'];
    }

    public function getPrice($currency): string
    {
        return $currency.' '.round($this->total, 2);
    }

    public function makeReservation($member)
    {
        //pegarle a algún endpoint para reservar
    }
}
