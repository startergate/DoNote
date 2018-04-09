<?php
  require("../lib/logchk2.php");
	require('../config/config.php');
	require('../lib/db.php');
  if ($_POST['confirm_user'] === '확인') {
    if (!empty($_POST['pw'])) {
      $pw_temp = $_POST['pw'];
      $password = hash("sha256",$pw_temp);
      $pid = $_SESSION['pid'];
    	$conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
    	$result = mysqli_query($conn, "SELECT * FROM donote_beta_userinfo");

    	$sql = "SELECT pw FROM donote_beta_userinfo WHERE pid LIKE '$pid'";	//user data select
      $result = mysqli_query($conn, $sql);
    	$row = mysqli_fetch_assoc($result);

      $hash = $row['pw'];
      if ($password === $hash) {
        $_SESSION['confirm'] = "1";
    		header('Location: ../user/edit_info.php');
      } else {
    		echo "<script>window.alert('틀린 비밀번호를 입력하셨습니다. 다시 입력해주세요.');</script>";
    		echo "<script>window.location=('../user/confirm.php');</script>";
    	}
    } else {
      echo "<script>window.alert('비밀번호가 입력되지 않았습니다');</script>";
      echo "<script>window.location=('../user/confirm.php');</script>";
    }
  }
?>
