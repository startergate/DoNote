<!DOCTYPE html>
<?php
  require("../lib/logchk2.php");
  require("../lib/userchk.php");
  require("../config/config_aco.php");
	require("../lib/db.php");
	$conn_n = db_init($confign["host"],$confign["duser"],$confign["dpw"],$confign["dname"]);
  //Select Profile Image
  $sql = "SELECT profile_img FROM userdata WHERE pid LIKE '".$_SESSION['pid']."'";
  $result = mysqli_query($conn_n, $sql);
  $row = mysqli_fetch_assoc($result);
  if (empty($row['profile_img'])) {
    $profileImg = "/static/img/common/donotepfo.png";
  } else {
    $profileImg = $row['profile_img'];
  }
  $_SESSION['confirm'] = 'refresh';
?>
<html lang="ko">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="/static/img/favicon/donote/favicon-16x16.png" type="image/x-icon" />
    <link rel="icon" href="/static/img/favicon/donote/favicon-16x16.png" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="57x57" href="/static/img/favicon/donote/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="/static/img/favicon/donote/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/static/img/favicon/donote/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/static/img/favicon/donote/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/static/img/favicon/donote/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/static/img/favicon/donote/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/static/img/favicon/donote/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/static/img/favicon/donote/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/static/img/favicon/donote/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192"  href="/static/img/favicon/donote/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/static/img/favicon/donote/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="/static/img/favicon/donote/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/static/img/favicon/donote/favicon-16x16.png" />
    <link rel="manifest" href="../manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/static/img/favicon/donote/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />
    <meta charset="utf-8" />
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/bg_style.css?v=1">
  	<link rel="stylesheet" type="text/css" href="../css/top.css">
  	<link rel="stylesheet" type="text/css" href="../css/master.css">
  	<link rel="stylesheet" type="text/css" href="/Normalize.css">
    <title>비밀번호 수정 | DoNote Beta</title>
  </head>
  <body>
    <div class="container-fluid" id='padding-erase'>
      <div class="fixed layer1" id="bgi" style="z-index: 2">
        <div class="col-md-3">
          <a href="../note.php" class='middle'><img src="/static/img/common/donotevec.png" alt="DoNote" class="img-rounded" id=logo alt='메인으로 가기' \></a>
        </div>
        <div class="col-md-9 text-right" id="bgiOptional">
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
    </div>
    <div class="container-fluid layer2" id="padding-generate-top" style="margin-top: 50px; z-index: 1">
      <div class="col-md-2">
        <ol class="nav" nav-stacked="" nav-pills="">
          <li><a href="../edit_info.php">기본정보 변경</li></a>
          <li><a href="../edit_pw.php">비밀번호 변경</li></a>
          <li><a href="../function/logout.php">로그아웃</li></a>
          <li><a href="../note.php">노트로 돌아가기</li></a>
        </ol>
      </div>
      <hr class="displayOptionMobile" />
      <div class="col-md-10">
        <form action="../function/edit_user_pw.php" method="post">
          <div class="form-group">
            <input type='password' class='form-control' name='pw' placeholder='비밀번호' />
          </div>
          <div class="form-group">
            <input type='password' class='form-control' name='confirm' placeholder='비밀번호 확인' />
          </div>
          <input type="submit" name="confirm_user_edit" value="비밀번호 수정!" class="btn btn-default btn-lg">
        </form>
      </div>
      <div id="padding-generate-bottom"></div>
    </div>
		<script src="/jquery/jquery-3.3.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>