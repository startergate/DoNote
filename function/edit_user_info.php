<?php
  require("../lib/logchk.php");
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  $nk = mysqli_real_escape_string($conn, $_POST['nickname']);
  $pw = mysqli_real_escape_string($conn, $_POST['pw']);
  $pid = $_SESSION['pid'];
  if (!empty($_POST['nickname'])) {
    $sql = "UPDATE donote_ahlpa_userinfo SET nickname='$nk' WHERE pid='$pid'";
    $result = mysqli_query($conn, $sql);
  }
  if (!empty($_POST['pw'])) {
    if ($_POST['pw'] === $_POST['confirm']) {
      $sql = "UPDATE donote_ahlpa_userinfo SET pw='$pw' WHERE pid='$pid'";
      $result = mysqli_query($conn, $sql);
      header('Location: ../complete/edit_user_info.php');
    } else {
      echo "<script>window.alert('비밀번호를 다시 입력해주세요.');</script>";
      echo "<script>window.location=('../user/edit_info.php');</script>";
      exit;
    }
  }
  header('Location: ../complete/edit_user_info.php');
?>
