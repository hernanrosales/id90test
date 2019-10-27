<?php

namespace App;

require_once 'Error.php';
require_once 'Helper.php';
require_once 'models/Member.php';

use App\Error;
use App\Helper;
use Models\Member;

class Session
{

    static function authenticate()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $airline = Helper::normalizeInput($_POST['airline']);
            $user = Helper::normalizeInput($_POST['user']);
            $password = Helper::normalizeInput($_POST['pass']);

            $url = 'https://beta.id90travel.com/session.json';
            $data = [
                'session' => [
                    'airline' => $airline,
                    'username' => $user,
                    'password' => $password,
                    'remember_me' => '1'
                ]
            ];

            $request = curl_init();

            curl_setopt($request, CURLOPT_URL, $url);
            curl_setopt($request, CURLOPT_POST, true);
            curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($request);
            $status = curl_getinfo($request, CURLINFO_HTTP_CODE);

            if ($status === 200) {
                $responseObject = json_decode($response);
                $_SESSION['member'] = new Member($responseObject->member);
                $_SESSION['expire'] = time() + 300;
                header('Location: dashboard.php');
            } else {
                if ($status === 401) {
                    $errno = Error::ERROR_LOGIN_INCORRECT;
                } else {
                    $errno = Error::ERROR_LOGIN_PROBLEM;
                }
                header('Location: index.php?error='.$errno);
            }
        } else {
            header('Location: index.php');
        }
    }

    static function checkSession()
    {
        session_start();
        if (isset($_SESSION['member']) && time() < $_SESSION['expire']) {
            $_SESSION['expire'] = time() + 300;
        } else {
            self::logout();
            exit;
        }
    }

    static function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }

}
