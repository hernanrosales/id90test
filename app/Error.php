<?php

namespace App;

class Error
{

    const ERROR_LOGIN_INCORRECT = 1;
    const ERROR_LOGIN_PROBLEM = 2;

    static function getErrorMessage($errno)
    {
        $message = 'Error desconocido';
        switch($errno) {
            case self::ERROR_LOGIN_INCORRECT:
            $message = 'Usuario o contraseña incorrecto.';
            break;
            case self::ERROR_LOGIN_PROBLEM:
            $message = 'Hubo un problema con el servidor, intente mas tarde.';
            break;
        }
        return $message;
    }
}
