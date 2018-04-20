<!DOCTYPE html>
<html>
  <head>
    <link rel="apple-touch-icon" sizes="57x57" href="/static/img/favicon/donote/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/static/img/favicon/donote/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/static/img/favicon/donote/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/static/img/favicon/donote/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/static/img/favicon/donote/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/static/img/favicon/donote/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/static/img/favicon/donote/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/static/img/favicon/donote/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/static/img/favicon/donote/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/static/img/favicon/donote/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/img/favicon/donote/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/static/img/favicon/donote/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/img/favicon/donote/favicon-16x16.png">
    <link rel="manifest" href="/donote/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/static/img/favicon/donote/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <title>DoNote Beta</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style2.css?ver=1.9">
  	<link rel="stylesheet" type="text/css" href="./css/bg_style.css?ver=1.5">
  	<link rel="stylesheet" type="text/css" href="./css/master.css">
  	<link rel="stylesheet" type="text/css" href="/Normalize.css">
  </head>
  <body id="bge">
    <div class="cover full-window">
      <div class="col-sm-12">
        <p class='text-center'>
          <strong id='domi'>DoNote</strong>
        </p>
        <div id="control">
          <p class='text-center'>
            <?php
            session_start();
            if ($empty = empty($_SESSION['pid'])) {
              echo $empty;
              echo "<div id='white'>".$_SESSION['nickname']."님, 돌아오신 것을 환영합니다.</div>";
            }
            if (!empty($_COOKIE['donoteAutorizeRikka'])) {
            	require('./config/config.php');
            	require('./lib/db.php');
            	$conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
              $sql = "SELECT pw,nickname,pid FROM donote_beta_userinfo WHERE autorize_tag = '".$_COOKIE["donoteAutorizeRikka"]."'";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_assoc($result);
              $pw_hash = hash('sha256', $row['pw']);
              $_COOKIE['donoteAutorizeYuuta']."<br>".$pw_hash;
              if ($pw_hash === $_COOKIE['donoteAutorizeYuuta']) {
                $_SESSION['nickname'] = $row['nickname'];
                $_SESSION['pid'] = $row['pid'];
                header("Location: ./note.php");
              }
            }
            ?>
            <a href="./login.php" class="btn btn-default btn-lg">로그인</a>
          </p>
        </div>
      </div>
    </div>
		<script src="/jquery/jquery-3.3.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
