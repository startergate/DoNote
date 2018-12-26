<!DOCTYPE html>
<?php
  require("../lib/sidUnified.php");
  require("../config/config.php");
  $SID = new SID("donote");
  //Select Note Database
  if (empty($_GET['id'])) {
      header('Location: ../function/error_confirm.php');
  }
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  //Note Database
  explode("_", $_GET['id']);

  //Select Note Text
  $sql = "SELECT name,text,edittime FROM notedb_".$_SESSION['pid']." WHERE id LIKE '".$id."'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $name = $row['name'];
  $text = $row['text'];
  $edittime = $row['edittime'];

  //Select Wheater to Share
  $sql = "SELECT shareTF, shareMod FROM sharedb_".$_SESSION['pid']." WHERE shareTable LIKE '".$id."_".$_SESSION['pid']."'";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
  $sTF = $row['shareTF'];
  $sMod = $row['shareMod'];

  $sqls = "SELECT shareTable,shareID FROM sharedb_".$_SESSION['pid']." WHERE shareTF = 1 AND shareMod = 2";
  $results = $conn -> query($sqls);
  $rows = $result -> fetch_assoc();
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
    <link rel="icon" type="image/png" sizes="192x192" href="../static/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../static/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../static/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../static/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../manifest.json">
    <meta name="msapplication-TileColor" content="#3d414d">
    <meta name="msapplication-TileImage" content="../static/img/favicon/ms-icon-144x144.png">
    <meta name="msapplication-config" content="../browserconfig.xml" />
    <meta name="theme-color" content="#3d414d">

    <!-- CSS 관련 구문 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
  	<link rel="stylesheet" type="text/css" href="../css/style.css?v=8">
    <link rel="stylesheet" type="text/css" href="../css/bg_style.css?v=1">
  	<link rel="stylesheet" type="text/css" href="../css/top.css">
  	<link rel="stylesheet" type="text/css" href="../css/list.css">
  	<link rel="stylesheet" type="text/css" href="../css/text.css">
  	<link rel="stylesheet" type="text/css" href="../css/Normalize.css">

    <!-- 페이지 설명 구문 -->
    <meta name="description" content="View Shared Note for Non-Login User - DoNote">
    <title><?=$name?> | DoNote Beta</title>
  </head>
  <body>
    <!-- [if IE]-->
      <script type="text/javascript">
        alert("Internet Explorer is NOT Supported.")
      </script>
    <!--[endif]-->
    <div class="container-fluid padding-erase">
      <div class="fixed layer1 bg bgi bgImg">
        <div class="col-md-3">
          <img src="../static/img/common/donotevec.png" alt="DoNote" class="img-rounded" id=logo alt='메인으로 가기' \>
        </div>
        <div class="col-md-9 text-right">
          <div class="btn-group dropdown">
            <button class="full-erase btn btn-link dropdown-toggle" type="button" id="white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src='/static/img/common/donotepfo.png' alt='Hello!' id='profile' class='img-circle' />
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" id="black" href="../user/confirm.php"><strong><span class='glyphicon glyphicon-cog' aria-hidden='true'></span> 정보 수정</strong></a></li>
              <li><a class="dropdown-item" id="black" href="./list.php"><strong><span class='glyphicon glyphicon-link' aria-hidden='true'></span> 공유한 노트 보기</strong></a></li>
              <li><a class="dropdown-item" id="black" href="../function/logout.php"><strong><span class='glyphicon glyphicon-off' aria-hidden='true'></span> 로그아웃</strong></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid layer2" id="padding-generate-top">
      <hr class="displayOptionMobile" />
      <div class="col-md-12">
          <div class="text-right edittime"><?php if ($sMod) {
    echo "수정하려면 로그인하세요 | ";
} ?>최근 수정 일자: <?=$edittime?></div>
          <div class="form-group">
            <textarea disabled><?=$name?></textarea>
          </div>
          <div class="form-group form-text">
            <textarea disabled><?=$text?></textarea>
          </div>
      </div>
      <div id="padding-generate-bottom"></div>
    </div>
    <script src="../lib/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
