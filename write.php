<!DOCTYPE html>
<?php
  session_start();
  $_SESSION['nickname'] = 'DEBUG';  //This Part MUST Be Removed After Login Page Making Completed.
  $_SESSION['uid'] = '2';
  $user = $_SESSION['nickname'];
?>
<?php
  //ob_start();
  //session_start();
  //if($_SESSION['uid'] == "") {
    //echo "<script>window.alert('로그인이 필요합니다.');</script>";
    //echo "<script>window.location=('./login.php');</script>";
  //exit;
  //} else {
    //$user = $_SESSION['nickname']
  //}
?>
<?php
	require("/config/config.php");
	require("/lib/db.php");
	$conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  $result = mysqli_query($conn, "SELECT * FROM donote_ahlpa_userznote_".$_SESSION['uid']);
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>DoNote Ahlpa 0.1</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="./style.css">
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
    <div class="col-md-12">
      <header class="jumbotron text-center">
        <strong><h1>DoNote</h1></strong>
      </header>
    </div>
    <div class="col-md-12">
      <header class="jumbotron text-right">
        <?php
          echo $user."님, 환영합니다."
        ?>
      </header>
    </div>
    </div>
    <div class="container">
    <div class="col-md-3">
        <?php
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<li><a href="./note.php?id='.$row['id'].'">'.$row["name"],'</li></a>'."\n";
            echo '<br />';
          }
        ?>
        <li><a href="./write.php">페이지 추가하기</li></a>
    </div>
    <div class="col-md-9">
      <form action="./process/new.php" method="post">
        <div class="form-group">
          <textarea type='text' class='form-control' name='name' id='form-title' placeholder='제목을 작성하세요.'></textarea>
        </div>
        <div class="form-group">
          <textarea class='form-control' name='text' id='form-title' placeholder='내용을 작성하세요.'></textarea>
        </div>
        <input type="submit" name="dummy_1" value="새로운 내용을 저장!" class="btn btn-default btn-lg">
      </form>
    </div>
    </div>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
