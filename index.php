<?php
require_once 'fx.php';

$url = 'https://beta.id90travel.com/airlines';
$options = [
    'http' => [
        'method' => 'GET'
    ]
];
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$airlines = json_decode($response);

if (isset($_GET['error'])) {
    $error = normalizeInput($_GET['error']);
    $errMsg = getErrorMessage($error);
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ID90 Travel Login</title>
    <link rel="stylesheet" href="main.css?v=<?php echo filemtime('main.css') ?>">
  </head>
  <body>
    <div class="layout">
      <h1>ID90 Travel</h1>
      <form id="login" enctype="multipart/form-data" action="authenticate.php" method="post">
        <h2>Ingreso</h2>
        <label for="airline">Aerolinea</label>
        <select id="airline" form="login" name="airline">
          <?php foreach ($airlines as $airline): ?>
            <option value="<?php echo $airline->id ?>">
              <?php echo $airline->display_name ?>
            </option>
          <?php endforeach; ?>
        </select>
        <input form="login" type="text" name="user" placeholder="Usuario" required>
        <input form="login" type="password" name="pass" placeholder="Clave" required>
        <?php if (isset($errMsg)): ?>
          <p class="error"><?php echo $errMsg ?></p>
        <?php endif; ?>
        <input form="login" type="submit" name="sendauth" value="Log In">
      </form>
    </div>
  </body>
</html>
