<?php

namespace Models;

abstract class Model
{
    function __construct($responseObject)
    {
        $array = json_decode(json_encode($responseObject), true);

        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }
}
