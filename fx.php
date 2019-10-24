<?php

const ERROR_LOGIN_INCORRECT = 1;
const ERROR_LOGIN_PROBLEM = 2;

function normalizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkSession()
{
    if (isset($_SESSION['member']) && time() < $_SESSION['expire']) {
        $_SESSION['expire'] = time() + 300;
    } else {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;
    }
}

function getErrorMessage($errno)
{
    $message = 'Error desconocido';
    switch($errno) {
        case ERROR_LOGIN_INCORRECT:
            $message = 'Usuario o contraseña incorrecto.';
            break;
        case ERROR_LOGIN_PROBLEM:
            $message = 'Hubo un problema con el servidor, intente mas tarde.';
            break;
    }
    return $message;
}
