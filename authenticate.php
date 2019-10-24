<?php
session_start();

require_once 'fx.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $airline = normalizeInput($_POST['airline']);
    $user = normalizeInput($_POST['user']);
    $password = normalizeInput($_POST['pass']);

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
        $_SESSION['member'] = $responseObject->member;
        $_SESSION['expire'] = time() + 300;
        header('Location: dashboard.php');
    } else {
        if ($status === 401) {
            $errno = 1;
        } else {
            $errno = 2;
        }
        header('Location: index.php?error='.$errno);
    }

}
