<?php
  require("../lib/logchk2.php");
  require("../config/config.php");
  require("../lib/db.php");
  if ($_POST['confirm_user_edit']) {
    $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
    $pw_temp = $_POST['pw']
    $password = hash("sha256",$pw_temp);
    $nk = mysqli_real_escape_string($conn, $_POST['nickname']);
    $pw = mysqli_real_escape_string($conn, $password);
    $pid = $_SESSION['pid'];
    if (empty($_POST['nickname'])) {
      if (empty($_POST['pw'])) {
        echo "<script>window.alert('변경 사항이 없습니다.');</script>";
        echo "<script>window.location=('../user/edit_info.php');</script>";
        exit;
      }
    }
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
    $_SESSION['confirm_user_edit'] = 'confirm';
    header('Location: ../complete/edit_user_info.php');
  } else {
    header('Location: ./error_confirm.php');
		exit;
  }
?>
