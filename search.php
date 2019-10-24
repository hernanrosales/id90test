<?php
session_start();
require_once 'fx.php';
checkSession();

require_once 'models/Hotel.php';

use Models\Hotel;

$hotels = array();

for ($i=0; $i < 7; $i++) {
    array_push($hotels, new Hotel());
}

// var_dump($hotels);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ID90 Travel - Hoteles</title>
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css') ?>">
  </head>
  <body>
    <div class="layout">
      <h1>ID90 Travel</h1>
      <h2>Resultados de la búsqueda</h2>
      <ul>
        <?php foreach ($hotels as $hotel): ?>
          <li>
            <strong><?php echo $hotel->name ?></strong><br>
            <br>
            <?php echo $hotel->city ?><br>
            Capacidad: <?php echo $hotel->capacity ?> personas <br>
            Precio por noche: <?php echo $hotel->pricePerNight ?> <br>
            Valoración: <?php echo $hotel->rate ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </body>
</html>

<!-- // $destination = normalizeInput($_GET['destination']);
// $checkin = normalizeInput($_GET['checkin']);
// $checkout = normalizeInput($_GET['checkout']);
// $guests = normalizeInput($_GET['guests']);

// $url = 'https://beta.id90travel.com/api/v1/hotels.json';
// $data = [
//     'guests' => '2',
//     'checkin' => '2018-10-24',
//     'checkout' => '2018-10-25',
//     'destination' => 'Cancun',
//     'keyword' => '',
//     'rooms' => '1',
//     'longitude' => '',
//     'latitude' => '',
//     'sort_criteria' => 'Overall',
//     'sort_order' => 'desc',
//     'per_page' => '25',
//     'page' => '1',
//     'currency' => 'USD',
//     'price_low' => '',
//     'price_high' => ''
// ];
// $options = [
//     'http' => [
//         'header' => 'content-type: application/x-www-form-urlencoded',
//         'method' => 'GET',
//         'content' => http_build_query($data)
//     ]
// ];
//
// $context = stream_context_create($options);
// $response = file_get_contents($url, false, $context);
// $hotels = json_decode($response); -->
