<?php
  require("../lib/logchk2.php");
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  if ($_POST['confirm_delete'] === '삭제!') {
    $pid = $_SESSION['pid'];
    $id = $_GET['id'];
    if ($id === '0') {
      echo "<script>window.alert('삭제할 수 없는 페이지입니다.');</script>";
      echo "<script>window.location=('../note.php');</script>";
      exit;
    }
    $udb = 'donote_ahlpa_userznote_'.$pid;
    $sql = "DELETE FROM $udb WHERE id='$id';";
    $result = mysqli_query($conn, $sql);
    $_SESSION['confirm_delete'] = 'confirm';
    header('Location: ../complete/delete.php?id='.$id);
  } else {
    header('Location: ../function/error_confirm.php');
  }
?>
