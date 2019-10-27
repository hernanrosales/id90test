<?php

require_once 'app/Helper.php';
require_once 'app/Error.php';
require_once 'models/Airline.php';

use App\Helper;
use App\Error;
use Models\Airline;

$url = 'https://beta.id90travel.com/airlines';
$options = [
    'http' => [
        'method' => 'GET'
    ]
];
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$json = json_decode($response);

$airlines = array();

foreach ($json as $airline) {
    array_push($airlines, new Airline($airline));
}

if (isset($_GET['error'])) {
    $errno = Helper::normalizeInput($_GET['error']);
    $errMsg = Error::getErrorMessage($errno);
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ID90 Travel Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-sm">
        <a class="mr-auto navbar-brand" href="#">ID90 Travel</a>
      </nav>
      <div class="row pt-3">
        <div class="col-3">
          <h2>Ingreso</h2>
          <form id="login" enctype="multipart/form-data" action="authenticate.php" method="post">
            <div class="form-group">
              <label for="airline">Aerolinea</label>
              <select id="airline" form="login" name="airline" class="form-control">
                <?php foreach ($airlines as $airline): ?>
                  <option value="<?php echo $airline->id ?>">
                    <?php echo $airline->display_name ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
            <label for="user">Usuario</label>
              <input form="login" type="text" name="user" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="pass">Clave</label>
              <input form="login" type="password" name="pass" class="form-control" required>
            </div>
            <?php if (isset($errMsg)): ?>
              <p class="text-danger"><?php echo $errMsg ?></p>
            <?php endif; ?>
            <input form="login" class="btn btn-primary" type="submit" name="sendauth" value="Log In">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
