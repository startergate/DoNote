<?php
  require("../config/config.php");
  require("../lib/db.php");
  session_start();
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $text = mysqli_real_escape_string($conn, $_POST['text']);
  $uid = $_SESSION['uid'];
  $udb = 'donote_ahlpa_userznote_'.$uid;
  $sql = "INSERT INTO $udb (name,text) VALUES ('$name','$text')";
  $result = mysqli_query($conn, $sql);
  $_SESSION['name'] = $name;
  header('Location: ../complete/write.php);
?>
