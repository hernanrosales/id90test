<?php
session_start();
require_once 'fx.php';
checkSession();
$member = $_SESSION['member'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ID90 Travel - Buscar hoteles</title>
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css') ?>">
  </head>
  <body>
    <div class="layout">
      <h1>ID90 Travel</h1>
      <h2>Búsqueda de hoteles</h2>
      <h3>¡Bienvenido, <?php echo $member->first_name.' '.$member->last_name ?>!</h3>
      <p>Aquí podrás buscar los mejores hoteles a tu alcance</p>
      <form id="search" enctype="multipart/form-data" action="search.php" method="get">
        <input type="text" form="search" name="destination" placeholder="Destino">
        <input type="date" form="search" name="checkin">
        <input type="date" form="search" name="checkout">
        <input type="number" form="search" name="guests" placeholder="Cantidad de viajeros">
        <input type="submit" form="search" name="dosearch" value="Buscar hoteles">
      </form>
    </div>
  </body>
</html>
