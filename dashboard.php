<?php

require_once 'app/Session.php';

use App\Session;

Session::checkSession();

$member = $_SESSION['member'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ID90 Travel - Buscar hoteles</title>
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
      <div class="row pt-3">
        <div class="col-4">
          <h2>Búsqueda de hoteles</h2>
          <p>Aquí podrás buscar los mejores hoteles a tu alcance</p>
          <form id="search" enctype="multipart/form-data" action="search.php" method="get">
            <div class="form-group">
              <label for="destination">Destino</label>
              <input class="form-control" type="text" form="search" name="destination">
            </div>
            <div class="form-group">
              <label for="checkin">Checkin</label>
              <input class="form-control" type="date" form="search" name="checkin">
            </div>
            <div class="form-group">
              <label for="checkout">Checkout</label>
              <input class="form-control" type="date" form="search" name="checkout">
            </div>
            <div class="form-group">
              <label for="guests">Cantidad de viajeros</label>
              <input class="form-control" type="number" form="search" name="guests">
            </div>
            <div class="form-group">
              <label for="dosearch"></label>
              <input class="btn btn-primary" type="submit" form="search" name="dosearch" value="Buscar hoteles">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
