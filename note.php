<!DOCTYPE html>
<?php
  session_start();
  $_SESSION['user'] = 'WORLD';
  $user = $_SESSION['user'];
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>DoNote Ahlpa 0.1</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="./style.css">
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
    <div class="col-md-3">
      <header class="jumbotron text-center">
        <strong><h4>DoNote</h4></strong>
      </header>
    </div>
    <div class="col-md-9">
      <header class="jumbotron text-right">
        <?php
          echo $user."님, 환영합니다."
        ?>
      </header>
    </div>
    </div>
  </body>
</html>
