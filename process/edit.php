<?php
  require("../config/config.php");
  require("../lib/db.php");
  require("../lib/logchk.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $text = mysqli_real_escape_string($conn, $_POST['text']);
  $pid = $_SESSION['pid'];
  $id = $_GET['id'];
  $udb = 'donote_ahlpa_userznote_'.$pid;
  $sql = "UPDATE $udb SET name='$name', text='$text' WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  header('Location: ../complete/edit.php?id='.$id);
?>
