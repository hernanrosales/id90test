<?php

namespace Models;

require_once 'Model.php';
require_once 'Member.php';

use Models\Model;
use Models\Member;

class Hotel extends Model
{
    public function getCity(): string
    {
        return $this->location['city'];
    }

    public function makeReservation($member)
    {
        //pegarle a algún endpoint para reservar
    }
}
