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
    <link rel="stylesheet" type="text/css" href="./css/style2.css?ver=2018-07-13_2">
  	<link rel="stylesheet" type="text/css" href="./css/bg_style.css?ver=1.5">
  	<link rel="stylesheet" type="text/css" href="./css/master.css">
  	<link rel="stylesheet" type="text/css" href="./css/Normalize.css">
    <style media="screen">
      .indexTitle{
        font-size: 6.2vw;
      }
      .imgLocation{
        position: relative;
        /*margin-bottom: 20vh;*/
        font-size: 10px;
        background-color:rgba(255,255,255,0.5);
        width:171px;
        top: 10px;
        left: 10px;
      }
    </style>
  </head>
  <body class='bg bge bgImg'>
    <p class="imgLocation">
    Image by Unsplash, ⓒ 2018 DoNote
    </p>
    <div id="index" class="cover full-window">
      <div class="col-sm-12 larger">
        <p class='text-center'>
          <strong class="indexTitle domi">DoNote</strong>
        </p>
        <div class="control">
          <p class='text-center'>
            <?php
              session_start();
              if (!empty($_SESSION['pid'])) {
                  echo "<div id='white'>".$_SESSION['nickname']."님, 돌아오신 것을 환영합니다.</div>";
                  echo "<script type=\"text/javascript\">setTimeout(\"location.href = './note.php'\", 5000);</script>";
                  echo "<div style='color:white'>곧 리다이렉트됩니다.</div>";
              } else {
                  echo "<button class='btn btn-light btn-lg' id='loginBtn1'>로그인</button>";
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
          </p>
        </div>
      </div>
    </div>
    <div id="login_form" class="covra covraLogin text-center" style="display:none">
      <div align="center">
        <div id="login">로그인 | DoNote</div>
        <div id="lotext" class="text-center">
          <br />
          <div align="center">
            <form id="form" action="./function/process_log.php" method="post">
              <input type="text" id="form" class="form-control" name="id" placeholder="아이디">
              <input type="password" id="form" class="form-control" name="pw" placeholder="비밀번호">
              <div class="checkbox">
                <input type="checkbox" name="auto"> 자동 로그인<br>자동 로그인 기능은 쿠키를 사용합니다.
              </div>
              <br />
              <input type="submit" name="confirm_login" class="btn btn-light" value="로그인">
              <button class='btn btn-light' id="registerBtn">회원가입</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="register" class="covra covraRegister text-center" style="display:none">
      <div align="center">
        <div id="login">회원가입 | DoNote</div>
        <div id="lotext">
          <br />
          <div align="center">
            <form id="form" action="./function/process_reg.php" method="post">
              <input type="text" id="form" class="form-control" name="id" placeholder="아이디">
              <input type="password" id="form" class="form-control" name="pw" placeholder="비밀번호">
              <input type="password" id="form" class="form-control" name="pwr" placeholder="비밀번호 확인">
              <input type="text" id="form" class="form-control" name="id" placeholder="닉네임">
              <br />
              <input type="submit" name="confirm_register" class="btn btn-light" value="회원가입">
              <button class='btn btn-light' id="loginBtn2">로그인</button>
            </form>
          </div>
        </div>
      </div>
    <script type="text/javascript">
      var logTarget1 = document.getElementById('loginBtn1');
      logTarget1.addEventListener('click', function(event) {
        $("#login_form").css('display', 'block');
        $("#register").css('display', 'none');
        $("#index").css('display', 'none');
      });
      var logTarget2 = document.getElementById('loginBtn2');
      logTarget2.addEventListener('click', function(event) {
        event.preventDefault()
        $("#login_form").css('display', 'block');
        $("#register").css('display', 'none');
        $("#index").css('display', 'none');
      });
      var regTarget = document.getElementById('registerBtn');
      regTarget.addEventListener('click', function(event) {
        event.preventDefault()
        $("#register").css('display', 'block');
        $("#index").css('display', 'none');
        $("#login_form").css('display', 'none');
      });
    </script>
		<script src="./lib/jquery-3.3.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
