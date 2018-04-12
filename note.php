<!DOCTYPE html>
<?php
  require("./lib/logchk.php");
	require("./config/config.php");
	require("./lib/db.php");
	$conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM donote_beta_usernote_".$_SESSION['pid']);
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
    <link rel="manifest" href="./manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/static/img/favicon/donote/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <title>DoNote Beta</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="./css/style.css?v=6">
    <link rel="stylesheet" type="text/css" href="./css/bg_style.css?v=1">
  	<link rel="stylesheet" type="text/css" href="./css/master.css">
  	<link rel="stylesheet" type="text/css" href="/Normalize.css">
  </head>
  <body>
    <div class="container-fluid" id='padding-erase'>
      <div class="fixed" id="bgi" style="z-index: 2">
        <div class="col-md-3">
          <a href="./note.php" class='middle'><img src="/static/img/common/donotevec.png" href="./note.php" alt="DoNote" class="img-rounded" id=logo alt='메인으로 가기' \></a>
        </div>
        <div class="col-md-9">
          <div class="text-right">
            <?php
              echo "<a href='./user/confirm.php' class='btn btn-link' id='white'>".$_SESSION['nickname']."님, 환영합니다.</a><a class='btn btn-link' href='./function/logout.php' id='white'>로그아웃</a>";
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid" id="padding-generate-top" style="margin-top: 50px; z-index: 1">
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
      <hr class="displayOptionMobile" />
      <div class="col-md-9">
        <?php
          if (empty($_GET['id'])) {
            $id = '1';
          } else {
            $id = $_GET['id'];
          }
          $sql = "SELECT name,text,edittime FROM donote_beta_usernote_".$_SESSION['pid']." WHERE id = ".$id;
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $name = $row['name'];
          $text = $row['text'];
          $edittime = $row['edittime'];
          echo '<form action="./process/edit.php?id='.$id.'" method="post">';
        ?>
          <div class="form-group">
            <?php
              echo "<textarea type='text' class='form-control' name='name' id='title' placeholder='제목을 작성하세요.'>".$name."</textarea>";
            ?>
          </div>
          <div class="text-right edittime">
            <?php
              echo "최근 수정 일자: ".$edittime;
            ?>
          </div>
          <div class="form-group form-text">
            <?php
              echo "<textarea class='form-control' name='text' id='text' placeholder='내용을 작성하세요.'>".$text."</textarea>";
            ?>
          </div>
          <input type="submit" name="confirm_edit" value="수정한 내용을 저장!" class="btn btn-default btn-lg">
          <?php
            echo "<a href='./delete.php?id=".$id."' class='btn btn-danger btn-lg'>이 내용을 삭제!</a>"
          ?>
        </form>
      </div>
      <div id="padding-generate-bottom"></div>
    </div>
    <script src="/jquery/jquery-3.3.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
