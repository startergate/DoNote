<?php
  require("../config/config.php");
  require("../lib/db.php");
  session_start();
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $text = mysqli_real_escape_string($conn, $_POST['text']);
  $uid = $_SESSION['uid'];
  $id = $_GET['id'];
  $udb = 'donote_ahlpa_userznote_'.$uid;
  $sql = "UPDATE $udb SET name='$name', text='$text' WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  header('Location: ../complete/edit.php?id='.$id);
?>
