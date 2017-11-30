<?php
  require("../lib/logchk2.php");
  require("../config/config.php");
	require("../lib/db.php");
  if ($_SESSION['confirm_write'] === 'confirm') {
    $name = $_SESSION['name'];
  	$conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
    $sql = "SELECT id FROM donote_ahlpa_userznote_".$_SESSION['pid']." WHERE name = '$name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($_SESSION['pid'] == "") {
      echo "<script>window.alert('로그인이 필요합니다.');</script>";
      echo "<script>window.location=('./login.php');</script>";
      $_SESSION['name'] = "";
      exit;
    } else {
      echo "<script>window.alert('수정이 완료되었습니다.');</script>";
      echo "<script>window.location=('../note.php?id=".$row['id']."');</script>";
      $_SESSION['name'] = "";
      exit;
    }
  } else {

      header('Location: ../function/error_confirm.php');
  }

?>
