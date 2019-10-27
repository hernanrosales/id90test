<?php

require_once 'app/Session.php';
require_once 'app/Helper.php';
require_once 'app/HotelFinder.php';
require_once 'models/Hotel.php';

use App\Session;
use App\Helper;
use App\HotelFinder;
use Models\Hotel;

Session::checkSession();

$member = $_SESSION['member'];

$destination = Helper::normalizeInput($_GET['destination']);
$checkin = Helper::normalizeInput($_GET['checkin']);
$checkout = Helper::normalizeInput($_GET['checkout']);
$guests = Helper::normalizeInput($_GET['guests']);

$hotels = HotelFinder::findHotels($destination, $checkin, $checkout, $guests);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ID90 Travel - Hoteles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-sm">
        <a class="mr-auto navbar-brand" href="#">ID90 Travel</a>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link"><?php echo $member->getFullname() ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-secondary btn-sm" href="logout.php">Cerrar sesión</a>
          </li>
        </ul>
      </nav>
      <h2>Resultados de la búsqueda</h2>
      <div class="card-columns mt-5">
        <?php foreach ($hotels as $hotel): ?>
          <div class="card">
            <img class="card-img" src="<?php echo $hotel->image ?>" >
            <div class="card-body">
              <h3 class="card-title"><?php echo $hotel->name ?></h3>
              <p class="card-text">
                <?php echo $hotel->getCity() ?><br>
                <strong>Precio:</strong> <?php echo $hotel->getPrice(Hotel::CURRENCY_USD) ?> <br>
                <strong>Valoración:</strong> <?php echo $hotel->star_rating ?>/5
              </p>
              <a href="#" class="btn btn-primary">Reservar</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </body>
</html>
