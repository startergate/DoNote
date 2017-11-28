<?php
  require("../config/config.php");
  require("../lib/db.php");
  require("../lib/logchk.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $text = mysqli_real_escape_string($conn, $_POST['text']);
  $pid = $_SESSION['pid'];
  $udb = 'donote_ahlpa_userznote_'.$pid;
  $sql = "INSERT INTO $udb (name,text) VALUES ('$name','$text')";
  $result = mysqli_query($conn, $sql);
  $_SESSION['name'] = $name;
  header('Location: ../complete/write.php');
?>
