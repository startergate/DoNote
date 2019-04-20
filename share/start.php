<!DOCTYPE html>
<?php
  require '../lib/sid.php';
  require '../config/config.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);  //Note Database

  $sql = 'SELECT name FROM notedb_'.$_SESSION['sid_pid']." WHERE id = '".$_GET['id']."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $name = $row['name'];

  //Select Profile Image
  $profileImg = 'temp';

  $sqls = 'SELECT * FROM sharedb_'.$_SESSION['sid_pid'].' WHERE shareTable = "'.$_SESSION['sid_pid'].'_'.$_GET['id'].'"';
  $results = $conn->query($sqls);
  $rows = $results->fetch_assoc();
  if ($rows) {
      header('Location: ../note.php');
  }
?>
<html lang="ko" dir="ltr">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131397158-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-131397158-1');
    </script>

    <!-- 호환성 관련 구문 -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <!-- 보안 -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline'  ; script-src 'self' https://www.google.com https://www.gstatic.com https://www.google-analytics.com 'unsafe-inline' 'unsafe-eval'; style-src 'self' http://fonts.googleapis.com 'unsafe-inline'; img-src *; font-src 'self' https://fonts.gstatic.com ;frame-src 'self' https://www.google.com; connect-src 'self' http://sid.donote.co:3000">
    <meta name="Cache-Control" content="public, max-age=60">

    <!-- 패비콘 관련 구문 -->
    <link rel="shortcut icon" href="../static/img/favicon/favicon-16x16.png" type="image/x-icon">
    <link rel="icon" href="../static/img/favicon/favicon-16x16.png" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="../static/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../static/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../static/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../static/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../static/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../static/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../static/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../static/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../static/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../static/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../static/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../static/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../static/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../manifest.json">
    <meta name="msapplication-TileColor" content="#3d414d">
    <meta name="msapplication-TileImage" content="../static/img/favicon/ms-icon-144x144.png">
    <meta name="msapplication-config" content="../browserconfig.xml" />
    <meta name="theme-color" content="#3d414d">

    <!-- FB 호환성 -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://donote.co">
    <meta property="og:title" content="DoNote">
    <meta property="og:image" content="http://donote.co/static/img/common/donoteico.png">
    <meta property="og:description" content="DoNote는 간단하면서도 편리한 노트입니다.">
    <meta property="og:site_name" content="DoNote">
    <meta property="og:locale" content="ko_KR">
    <meta property="og:image:width" content="1000">
    <meta property="og:image:height" content="1000">

    <!-- 트위터 호환성 -->
    <meta name="twitter:card" content="DoNote">
    <meta name="twitter:url" content="http://donote.co/">
    <meta name="twitter:title" content="DoNote">
    <meta name="twitter:description" content="DoNote는 간단하면서도 편리한 노트입니다.">
    <meta name="twitter:image" content="http://donote.co/static/img/common/donoteico.png">

    <!-- CSS 관련 구문 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/bg_style.css?v=1">
  	<link rel="stylesheet" type="text/css" href="../css/top.css">
  	<link rel="stylesheet" type="text/css" href="../css/list.css">
  	<link rel="stylesheet" type="text/css" href="../css/select.css">
  	<link rel="stylesheet" type="text/css" href="../css/master.css">
  	<link rel="stylesheet" type="text/css" href="../css/Normalize.css">

    <!-- JS 관련 구문 -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src='../lib/reCaptchaEnabler.js'></script>

    <!-- 페이지 설명 구문 -->
    <meta name="description" content="Start Sharing - DoNote">
    <title>공유 시작 | DoNote</title>
  </head>
  <body>
    <!--[if IE]>
      <script type="text/javascript">
        alert("Internet Explorer is NOT Supported.")
      </script>
    <![endif]-->
    <div class="container-fluid padding-erase">
      <div class="fixed layer1 bg bgi bgImg">
        <div class="col-md-3" style="font-size: 30px">
          <a href="../note.php" id='white'><img src="../static/img/common/donotevec.png" alt="DoNote" class="img-rounded" id=logo alt='DoNote' style='margin-top: -5px' \> Share!</a>
        </div>
        <div class="col-md-9 text-right">
          <div class="btn-group dropdown">
            <button class="full-erase btn btn-link dropdown-toggle" type="button" id="white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src='<?php echo $profileImg."' alt='".$_SESSION['sid_nickname']?>' id='profile' class='img-circle' />
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" id="black" href="../user/confirm.php"><strong><span class='glyphicon glyphicon-cog' aria-hidden='true'></span> 정보 수정</strong></a></li>
              <li><a class="dropdown-item" id="black" href="./list.php"><strong><span class='glyphicon glyphicon-link' aria-hidden='true'></span> 공유한 노트 보기</strong></a></li>
              <li><a class="dropdown-item" id="black" href="../function/logout.php"><strong><span class='glyphicon glyphicon-off' aria-hidden='true'></span> 로그아웃</strong></a></li>
              <li role="separator" class="divider"></li>
              <li><p class="dropdown-item text-center" id="black"><strong><?=$_SESSION['sid_nickname']?>님, 환영합니다.</strong></p></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid layer2" id="padding-generate-top" style="margin-top: 50px; z-index: 1">
      <div class="col-md-2 noteList">
          <iframe src="../frontend/list.php?v=2018-10-04_1" style="border:0" width="100%" height="100%"></iframe>
      </div>
      <hr class="displayOptionMobile" />
      <div class="col-md-10">
        <header class="jumbotron text-center" id="delete">
          <div class="deleteMiddle">
            <h1><?=$name?></h1>
            <h2>공유를 시작합니다.</h2>
            <form class='margin_42_gen' action='./function/start.php?id=<?=$_GET['id']?>' method='post'>
              <input type="checkbox" name="edit"> 편집 허용
              <br />
              <br />
              <input type='submit' id='saveBtnTop' name='confirm_start' class='btn btn-success btn-lg' value='확인!' disabled>
              <a href='./note.php?id=<?=$id?>' class='btn btn-danger btn-lg'>취소!</a>
              <hr>
              <div class="g-recaptcha selectRecaptcha" data-callback="saveEnable" data-expired-callback="saveDisable" data-sitekey="6LdYE2UUAAAAAH75nPeL2j1kYBpjaECBXs-TwYTA"></div>
            </form>
          </div>
        </header>
      </div>
      <div id="padding-generate-bottom"></div>
    </div>
		<script src="../lib/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
