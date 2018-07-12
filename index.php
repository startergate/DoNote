<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="57x57" href="./static/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./static/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./static/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./static/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./static/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./static/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./static/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./static/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./static/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="./static/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./static/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./static/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./static/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="./manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="./static/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <title>DoNote Beta</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style2.css?ver=2018-07-12_3">
  	<link rel="stylesheet" type="text/css" href="./css/bg_style.css?ver=1.5">
  	<link rel="stylesheet" type="text/css" href="./css/master.css">
  	<link rel="stylesheet" type="text/css" href="./css/Normalize.css">
    <style media="screen">
      .fuller{
        height: 100vh;
      }
      .indexTitle{
        font-size: 6.2vw;
      }
      .img_location{
        margin-bottom: 20vh;
        font-size: 1vw;
      }
    </style>
  </head>
  <body id='bge_img' class='fuller'>
    <div class="cover full-window">
      <div class="col-sm-12 larger">
        <p class='text-center'>
          <strong class="indexTitle" id='domi'>DoNote</strong>
        </p>
        <div id="control">
          <p class='text-center'>
            <?php
              session_start();
              if (!empty($_SESSION['pid'])) {
                  echo "<div id='white'>".$_SESSION['nickname']."님, 돌아오신 것을 환영합니다.</div>";
                  echo "<script type=\"text/javascript\">setTimeout(\"location.href = './note.php'\", 5000);</script>";
                  echo "<div style='color:white'>곧 리다이렉트됩니다.</div>";
              } else {
                  echo "<a href='./login.html' class='btn btn-default btn-lg'>로그인</a>";
              }
              if (!empty($_COOKIE['donoteAutorizeRikka'])) {
                  require('./config/config_aco.php');
                  require('./lib/db.php');
                  $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);
                  $sql = "SELECT pw,nickname,pid FROM userdata WHERE autorize_tag = '".$_COOKIE["donoteAutorizeRikka"]."'";
                  $result = mysqli_query($conn_n, $sql);
                  $row = mysqli_fetch_assoc($result);
                  $pw_hash = hash('sha256', $row['pw']);
                  if ($pw_hash === $_COOKIE['donoteAutorizeYuuta']) {
                      $_SESSION['nickname'] = $row['nickname'];
                      $_SESSION['pid'] = $row['pid'];
                      header("Location: ./note.php");
                  }
              }
            ?>
            <p class="img_location">
              Gardens By the Bay, Singapore, ⓒ 2018 DoNote
            </p>
          </p>
        </div>
      </div>
    </div>
		<script src="./lib/jquery-3.3.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
