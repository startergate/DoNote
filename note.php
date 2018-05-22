<!DOCTYPE html>
<?php
  require("./lib/logchk.php");
  require("./config/config.php");
  require("./config/config_aco.php");
  require("./lib/db.php");
  //Select Note Database
  if (empty($_GET['id'])) {
      $id = 'startergatedonotedefaultregister';
  } else {
      $id = $_GET['id'];
  }
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  //Note Database
  $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);  //User Database

  //Select Note Text
  $sql = "SELECT name,text,edittime FROM notedb_".$_SESSION['pid']." WHERE id LIKE '".$id."'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $text = $row['text'];
  $edittime = $row['edittime'];

  //Select Wheater to Share
  $sql = "SELECT shareTF, shareMod FROM sharedb_".$_SESSION['pid']." WHERE id LIKE '".$id."'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $sTF = $row['shareTF'];
  $sMod = $row['shareMod'];

  //Select Profile Image
  $sql = "SELECT profile_img FROM userdata WHERE pid LIKE '".$_SESSION['pid']."'";
  $result = mysqli_query($conn_n, $sql);
  $row = mysqli_fetch_assoc($result);
  if (empty($row['profile_img'])) {
      $profileImg = "./static/img/common/donotepfo.png";
  } else {
      $profileImg = $row['profile_img'];
  }
?>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="./static/img/favicon/favicon-16x16.png" type="image/x-icon">
    <link rel="icon" href="./static/img/favicon/favicon-16x16.png" type="image/x-icon">
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
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/master.css">
  	<link rel="stylesheet" type="text/css" href="./css/style.css?v=8">
    <link rel="stylesheet" type="text/css" href="./css/bg_style.css?v=1">
  	<link rel="stylesheet" type="text/css" href="./css/top.css">
  	<link rel="stylesheet" type="text/css" href="./css/Normalize.css">
    <title><?php echo $name;?> | DoNote Beta</title>
  </head>
  <body>
    <div class="container-fluid" id='padding-erase'>
      <div class="fixed layer1" id="bgi">
        <div class="col-md-3">
          <a href="./note.php"><img src="./static/img/common/donotevec.png" alt="DoNote" class="img-rounded" id=logo alt='메인으로 가기' \></a>
        </div>
        <div class="col-md-9 text-right" id="bgiOptional">
          <div class="btn-group dropdown">
            <button class="full-erase btn btn-link dropdown-toggle" type="button" id="white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src='<?php echo $profileImg."' alt='".$_SESSION['nickname']?>' id='profile' class='img-circle' />
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" id="black" href="./user/confirm.php"><strong><span class='glyphicon glyphicon-cog' aria-hidden='true'></span> 정보 수정</strong></a></li>
              <li><a class="dropdown-item" id="black" href="./share/list.php"><strong><span class='glyphicon glyphicon-link' aria-hidden='true'></span> 공유한 문서 보기</strong></a></li>
              <li><a class="dropdown-item" id="black" href="./function/logout.php"><strong><span class='glyphicon glyphicon-off' aria-hidden='true'></span> 로그아웃</strong></a></li>
              <li role="separator" class="divider"></li>
              <li><p class="dropdown-item text-center" id="black"><strong><?php echo $_SESSION['nickname']?>님, 환영합니다</strong></p></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid layer2" id="padding-generate-top">
      <div class="col-md-2">
        <ol class="nav" nav-stacked="" nav-pills="">
          <?php
            $result = mysqli_query($conn, "SELECT * FROM notedb_".$_SESSION['pid']);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li><a href="./note.php?id='.$row['id'].'">'.$row["name"].'</li></a><hr class="hrControlNote">';
            }
          ?>
          <li><a href="./write.php">페이지 추가하기</li></a>
        </ol>
      </div>
      <hr class="displayOptionMobile" />
      <div class="col-md-10">
        <form action="./process/edit.php?id=<?php echo $id?>" method="post">
          <input type="submit" name="confirm_edit" value="저장" class="btn btn-default">
          <a href='./delete.php?id=<?php echo $id?>' class='btn btn-danger'><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 삭제</a>
            <?php
              if ($sTF) {
                  if ($sMod == 2) {
                      echo "<a href='./share/add.php?id='".$id."' class='btn btn-info'><span class='glyphicon glyphicon-link' aria-hidden='true'></span> 공유</span></a>";
                  }
                  echo "<a href='./share/stop.php?id='".$id."' class='btn btn-info'><span class='glyphicon glyphicon-link' aria-hidden='true'></span> 공유 해제</span></a>";
              } else {
                  echo "<a href='./share/start.php?id='".$id."' class='btn btn-info'><span class='glyphicon glyphicon-link' aria-hidden='true'></span> 공유</span></a>";
              }
            ?>
          <div class="text-right edittime">최근 수정 일자: <?php echo $edittime?></div>
          <div class="form-group">
            <textarea type='text' class='form-control' name='name' id='title' placeholder='제목을 작성하세요.'><?php echo $name?></textarea>
          </div>
          <div class="form-group form-text">
              <textarea class='form-control' name='text' id='text' placeholder='내용을 작성하세요.'><?php echo $text?></textarea>
          </div>
          <input type="submit" name="confirm_edit" value="저장" class="btn btn-default">
          <a href='./delete.php?id=<?php echo $id?>' class='btn btn-danger'><span class="glyphicon glyphicon-remove" aria-hidden="true"> 삭제</a>
          <a href='./share/start.php?id=<?php echo $id?>' class='btn btn-info'><span class="glyphicon glyphicon-link" aria-hidden="true"> 공유</span></a>
        </form>
      </div>
      <div id="padding-generate-bottom"></div>
    </div>
    <script src="./lib/jquery-3.3.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
