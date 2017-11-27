<?php
  require("../config/config.php");
  require("../lib/db.php");
  session_start();

  $sql = "SELECT pid FROM donote_ahlpa_userinfo WHERE id LIKE '".$_SESSION['temp']."'";
  $result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
  $udb = 'donote_ahlpa_userznote_'.$row['pid'];

  $sql = "CREATE TABLE $udb (name LONGTEXT NOT NULL,text LONGTEXT NOT NULL,id INT(11) NOT NULL,PRIMARY KEY (id))";
  $result = mysqli_query($conn, $sql);

  $sql = "INSERT INTO $udb (name,text) VALUES ('안녕하세요. DoNote를 이용해주셔서 감사합니다.','이 웹앱은 Ahlpa상태이며, 보안적으로 매우 취약합니다. 개인적인 정보를 기록하지 마세요.')";
  $result = mysqli_query($conn, $sql);
  echo "<script>window.alert('회원가입이 완료되었습니다. 로그인 해주세요.');</script>";
  echo "<script>window.location=('../login.php');</script>";
  exit;
?>
