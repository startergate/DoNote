<!DOCTYPE html>
<?php
  require("../lib/logchk2.php");
  if($_SESSION['confirm'] === "") {
    echo "<script>window.alert('인증이 필요합니다.');</script>";
    echo "<script>window.location=('./confirm.php');</script>";
    exit;
  }
  $_SESSION['confirm'] = '';
	require("../config/config.php");
	require("../lib/db.php");
	$conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM donote_ahlpa_userznote_".$_SESSION['pid']);
?>
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
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/static/img/favicon/donote/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <title>DoNote Ahlpa</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/bg_style.css?v=1">
  	<link rel="stylesheet" type="text/css" href="../css/master.css">
  	<link rel="stylesheet" type="text/css" href="/Normalize.css">
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container-fluid" id='padding-erase'>
      <div id="bgi">
        <div class="col-md-3">
          <a href="../note.php" class='middle'><img src="/static/img/common/donotevec.png" alt="DoNote" class="img-rounded" id=logo alt='메인으로 가기' \></a>
        </div>
        <div class="col-md-9">
          <div class="text-right">
            <?php
              echo "<a href='./confirm.php' class='btn btn-link' id='white'>".$_SESSION['nickname']."님, 환영합니다.</a><a class='btn btn-link' href='../function/logout.php' id='white'>로그아웃</a>";
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid" id="padding-generate-top">
        <div class="col-md-3">
          <ol class="nav" nav-stacked="" nav-pills="">
            <?php
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<li><a href="./note.php?id='.$row['id'].'">'.$row["name"],'</li></a>'."\n";
              }
            ?>
            <li><a href="./write.php">페이지 추가하기</li></a>
          </ol>
        </div>
      <div id="padding-generate-bottom"></div>
      <div class="col-md-9">
        <?php
          echo '<form action="../function/edit_user_info.php" method="post">';
        ?>
        <div class="form-group">
          <?php
            echo "<textarea type='text' class='form-control' name='nickname' id='form-title' placeholder='닉네임(비워두시면 닉네임이 변경되지 않습니다.)'></textarea>";
          ?>
        </div>
        <div class="form-group">
          <?php
            echo "<input type='password' class='form-control' name='pw' id='form-title' placeholder='비밀번호(비워두시면 비밀번호가 변경되지 않습니다.)'>";
          ?>
        </div>
        <div class="form-group">
          <?php
            echo "<input type='password' class='form-control' name='confirm' id='form-title' placeholder='비밀번호 확인(비밀번호 입력 란이 비어있다면, 입력하지 마세요.)'>";
          ?>
        </div>
          <input type="submit" name="confirm_user_edit" value="수정한 내용을 저장!" class="btn btn-default btn-lg">
        </form>
      </div>
    </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
