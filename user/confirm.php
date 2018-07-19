<!DOCTYPE html>
<?php
  require("../lib/logchk2.php");
  require(".,/lib/sidUnified.php");
  require("../config/config.php");
  require("../config/config_aco.php");
  require("../lib/db.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  //Note Database
  $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);  //User Database

  //Select Profile Image
  $profileImg = profileGet($_SESSION['pid'], $conn_n, "..");
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
    <link rel="manifest" href="../manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../static/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>DoNote Beta</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/bg_style.css?v=1">
  	<link rel="stylesheet" type="text/css" href="../css/top.css">
  	<link rel="stylesheet" type="text/css" href="../css/list.css">
  	<link rel="stylesheet" type="text/css" href="../css/master.css">
  	<link rel="stylesheet" type="text/css" href="../css/Normalize.css">
  </head>
  <body>
    <div class="container-fluid" id='padding-erase'>
      <div class="fixed layer1 bg bgi bgImg">
        <div class="col-md-3" style="font-size: 30px">
          <a href="../note.php" id='white'><img src="../static/img/common/donotevec.png" alt="DoNote" class="img-rounded" id=logo alt='DoNote' style='margin-top: -5px' \>사용자 정보 수정</a>
        </div>
        <div class="col-md-9 text-right">
          <div class="btn-group dropdown">
            <button class="full-erase btn btn-link dropdown-toggle" type="button" id="white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src='<?php echo $profileImg."' alt='".$_SESSION['nickname']?>' id='profile' class='img-circle' />
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" id="black" href="../user/confirm.php"><strong>정보 수정</strong></a></li>
              <li><a class="dropdown-item" id="black" href="../function/logout.php"><strong>로그아웃</strong></a></li>
              <li role="separator" class="divider"></li>
              <li><p class="dropdown-item text-center" id="black"><strong><?php echo $_SESSION['nickname']?>님, 환영합니다.</strong></p></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid layer2" id="padding-generate-top" style="margin-top: 50px; z-index: 1">
      <div class="col-md-2">
        <ol class="nav" nav-stacked="" nav-pills="">
          <div class="donoteIdentifier" style="">노트</div><hr class='hrControlNote'>
          <?php
            $result = mysqli_query($conn, "SELECT id,name FROM notedb_".$_SESSION['pid']);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li><a href="../note.php?id='.$row['id'].'">'.$row["name"].'</li></a><hr class="hrControlNote">';
            }
          ?>
          <li><a href="../write.php">페이지 추가하기</li></a><hr class="hrControlNote">
          <!--<div class="donoteIdentifier">공유받은 페이지</div><hr class="hrControlNote">-->
          <?php
            /*if (!$rows) {
                echo '<li>공유 받은 항목이 없습니다.</li><hr class="hrControlNote">';
            } else {
                $noteData = explode('_', $rows['shareTable']);
                $sqle = "SELECT name FROM notedb_".$noteData[1]." WHERE id LIKE '".$noteData[0]."'";
                $resulte = mysqli_query($conn, $sqle);
                $rowe = mysqli_fetch_assoc($resulte);
                echo '<li><a href="../share/view.php?shareID='.$rows['shareID'].'">'.$rowe["name"].'</li></a><hr class="hrControlNote">';
                while ($rows = mysqli_fetch_assoc($results)) {
                    $noteData = explode('_', $rows['shareTable']);
                    $sqle = "SELECT name FROM notedb_".$noteData[1]." WHERE id LIKE '".$noteData[0]."'";
                    $resulte = mysqli_query($conn, $sqle);
                    $rowe = mysqli_fetch_assoc($resulte);
                    echo '<li><a href="../share/view.php?shareID='.$rows['shareID'].'">'.$rowe["name"].'</li></a><hr class="hrControlNote">';
                }
            }*/
          ?>
          <!--<li><a href="../share/accept.php">코드 추가하기</li></a><hr class="hrControlNote">-->
        </ol>
      </div>
      <hr class="displayOptionMobile" />
      <div class="col-md-10">
        <form action="../function/edit_confirm.php" method="post" class="text-center">
          <div class="form-group">
            <label for="pw"><h2>비밀번호 확인이 필요합니다.</h2></label>
            <input type='password' class='form-control' name='pw' id='form-title' placeholder='비밀번호 확인' style="width: 50%; margin-left: 25%" />
          </div>
          <input type="submit" name="confirm_user" value="확인" class="btn btn-default btn-lg" />
        </form>
      </div>
      <div id="padding-generate-bottom"></div>
    </div>
		<script src="../lib/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
