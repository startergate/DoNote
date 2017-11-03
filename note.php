<!DOCTYPE html>
<?php
  session_start();
  $_SESSION['nickname'] = 'DEBUG';
  $user = $_SESSION['nickname'];
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
    <div class="container">
    <div class="col-md-3">
      <header class="jumbotron text-left">
        DEBUGING!!
      </header>
    </div>
    <div class="col-md-9">
      <form action="process.php" method="post">
        <div class="form-group">
          <?php
            echo "<input type='text' class='form-control' name='title' id='form-title' placeholder=".$title.">";
          ?>
        </div>
        <div class="form-group">
          <?php
            echo "<textarea class='form-control' name='description' id='form-title' placeholder=".$text." rows=10></textarea>";
          ?>
        </div>
        <input type="submit" name="name" class="btn btn-default btn-lg">
      </form>
    </div>
    </div>
  </body>
</html>
