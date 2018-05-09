<!DOCTYPE html>
<?php
  require("./lib/logchk.php");
	require("./config/config.php");
	require("./config/config_aco.php");
	require("./lib/db.php");
  if (empty($_GET['id'])) {
    if (!$_GET['id'] == 0) {
      header('Location: ./function/error_confirm.php');
    }
  }
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);  //Note Database
  $conn_n = db_init($confign["host"],$confign["duser"],$confign["dpw"],$confign["dname"]);  //User Database
  //Select Note Database
  $id = $_GET['id'];
  $sqli = "SELECT name,text FROM notedb_".$_SESSION['pid']." WHERE id = '".$id."'";
  $resulti = mysqli_query($conn, $sqli);
  $row = mysqli_fetch_assoc($resulti);
  $name = $row['name'];
  $text = $row['text'];

  //Select Profile Image
  $sql = "SELECT profile_img FROM userdata WHERE pid LIKE '".$_SESSION['pid']."'";
  $result = mysqli_query($conn_n, $sql);
  $row = mysqli_fetch_assoc($result);
  if (empty($row['profile_img'])) {
    $profileImg = "/static/img/common/donotepfo.png";
  } else {
    $profileImg = $row['profile_img'];
  }
?>
<html lang="ko">
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
    <link rel="manifest" href="./manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/static/img/favicon/donote/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="./css/style.css?ver=1">
    <link rel="stylesheet" type="text/css" href="./css/bg_style.css">
  	<link rel="stylesheet" type="text/css" href="./css/top.css">
  	<link rel="stylesheet" type="text/css" href="./css/master.css">
  	<link rel="stylesheet" type="text/css" href="/Normalize.css">
    <style media="screen">
    @media (min-height: 700px) {
      .deleteMiddle{
        margin-top: 135px;
      }
      #delete{
        height: 555px;
      }
    }
    @media (min-height: 800px) {
      .deleteMiddle{
        margin-top: 185px;
      }
      #delete{
        height: 655px;
      }
    }
    @media (min-height: 900px) {
      .deleteMiddle{
        margin-top: 235px;
      }
      #delete{
        height: 755px;
      }
    }
    @media (min-height: 1000px) {
      .deleteMiddle{
        margin-top: 285px;
      }
      #delete{
        height: 855px;
      }
    }
    </style>
    <title><?php echo $name;?> 삭제 | DoNote Beta</title>
  </head>
  <body>
    <div class="container-fluid" id='padding-erase'>
      <div class="fixed layer1" id="bgi" style="z-index: 2">
        <div class="col-md-3">
          <a href="./note.php" class='middle'><img src="/static/img/common/donotevec.png" alt="DoNote" class="img-rounded" id=logo alt='메인으로 가기' \></a>
        </div>
        <div class="col-md-9 text-right" id="bgiOptional">
          <div class="btn-group dropdown">
            <button class="full-erase btn btn-link dropdown-toggle" type="button" id="white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src='<?php echo $profileImg."' alt='".$_SESSION['nickname']?>' id='profile' class='img-circle' />
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" id="black" href="./user/confirm.php"><strong>정보 수정</strong></a></li>
              <li><a class="dropdown-item" id="black" href="./function/logout.php"><strong>로그아웃</strong></a></li>
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
          <?php
            $result = mysqli_query($conn, "SELECT * FROM notedb_".$_SESSION['pid']);
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<li><a href="./note.php?id='.$row['id'].'">'.$row["name"],'</li></a>'."\n";
            }
          ?>
          <li><a href="./write.php">페이지 추가하기</li></a>
        </ol>
      </div>
      <hr class="displayOptionMobile" />
      <div class="col-md-10">
        <header class="jumbotron text-center" id="delete">
          <div class="deleteMiddle">
            <h1><?php echo $name;?></h1>
            <h2>위 내용을 삭제하시겠습니까?</h2>
            <br />
            <form class='margin_42_gen' action='./process/delete.php?id=<?php echo $id;?>' method='post'>
              <input type='submit' name='confirm_delete' class='btn btn-danger btn-lg' value='삭제!'>
              <a href='./note.php?id=<?php echo $id;?>' class='btn btn-success btn-lg'>취소!</a>
            </form>
          </div>
        </header>
      </div>
      <div id="padding-generate-bottom"></div>
    </div>
		<script src="/jquery/jquery-3.3.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
