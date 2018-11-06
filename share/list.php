<!DOCTYPE html>
<?php
  require("../lib/sidUnified.php");
  require("../config/config.php");
  $SID = new SID("donote");
  $SID -> loginCheck("../");
  if (empty($_GET['id'])) {
      $id = 'startergatedonotedefaultregister';
  } else {
      $id = $_GET['id'];
  }
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  //Note Database
  //Select Note Database

  $pid = $_SESSION['pid'];

  //Select Profile Image
  $profileImg = $SID -> profileGet($pid, "..");

  $sql = "SELECT shareTable,shareID,shareMod FROM sharedb_$pid WHERE shareTF LIKE 1";
  $result = $conn -> query($sql);
  $row = $result -> fetch_assoc();
?>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <link rel="manifest" href="./manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../static/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="../css/style.css?v=7">
    <link rel="stylesheet" type="text/css" href="../css/bg_style.css?v=1">
  	<link rel="stylesheet" type="text/css" href="../css/top.css">
  	<link rel="stylesheet" type="text/css" href="../css/list.css">
  	<link rel="stylesheet" type="text/css" href="../css/master.css">
  	<link rel="stylesheet" type="text/css" href="../css/Normalize.css">
    <title>공유된 노트 | DoNote Beta</title>
  </head>
  <body>
    <div class="container-fluid padding-erase">
      <div class="fixed layer1 bg bgi bgImg">
        <div class="col-md-3" style="font-size: 30px">
          <a href="../note.php" id='white'><img src="../static/img/common/donotevec.png" alt="DoNote" class="img-rounded" id=logo alt='DoNote' style='margin-top: -5px' \> Share!</a>
        </div>
        <div class="col-md-9 text-right">
          <div class="btn-group dropdown">
            <button class="full-erase btn btn-link dropdown-toggle" type="button" id="white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src='<?php echo $profileImg."' alt='".$_SESSION['nickname']?>' id='profile' class='img-circle' />
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" id="black" href="../user/confirm.php"><strong><span class='glyphicon glyphicon-cog' aria-hidden='true'></span> 정보 수정</strong></a></li>
              <li><a class="dropdown-item selected" id="black" href="./list.php"><strong><span class='glyphicon glyphicon-link' aria-hidden='true'></span> 공유한 노트 보기</strong></a></li>
              <li><a class="dropdown-item" id="black" href="../function/logout.php"><strong><span class='glyphicon glyphicon-off' aria-hidden='true'></span> 로그아웃</strong></a></li>
              <li role="separator" class="divider"></li>
              <li><p class="dropdown-item text-center" id="black"><strong><?php echo $_SESSION['nickname']?>님, 환영합니다</strong></p></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid layer2" id="padding-generate-top">
      <div class="col-md-12">
        <ol class="nav" nav-stacked="" nav-pills="">
          <?php
            if (!$row) {
                echo '<li>아직 공유한 항목이 없습니다.</li><hr class="hrControlNote">';
            } else {
                do {
                    $sMd = $row['shareMod'];
                    if ($sMd == 0) {
                        $shareStat = '링크를 가진 모든 유저에게 공유';
                    } elseif ($sMd == 1) {
                        $shareStat = '지정된 유저에게만 공유';
                    } elseif ($sMd == 2) {
                        $shareStat = '공유 받음';
                    } else {
                        continue;
                    }
                    $sTab = $row['shareTable'];
                    $noteData = explode('_', $sTab);
                    $sqle = "SELECT name FROM notedb_".$noteData[1]." WHERE id LIKE '".$noteData[0]."'";
                    $resulte = $conn -> query($conn, $sqle);
                    $rowe = $resulte -> fetch_assoc();
                    echo '<li><a href="./shared-stat.php?shareID='.$row['shareID'] .'">'.$rowe['name']."<div class='text-right'>".$shareStat."</div>".'</li></a><hr class="hrControlNote">';
                } while ($row = $result -> fetch_assoc());
            }
          ?>
        </ol>
      </div>
      <div id="padding-generate-bottom"></div>
    </div>
    <script src="../lib/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
