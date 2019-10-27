<?php

namespace Models;

require_once 'Model.php';

use Models\Model;

class Member extends Model
{
    public function getFullname()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
