<?php
  require("../lib/logchk.php");
  require("../config/config.php");
  require("../lib/db.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
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
  header('Location: ../complete/delete.php?id='.$id);
?>
