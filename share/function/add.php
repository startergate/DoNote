<?php
  require("../../config/config.php");
  require("../../lib/sidUnified.php");
  $SID = new SID('donote');
  $SID -> loginCheck("../../");
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if ($_POST['confirm_code'] === '확인') {
      $code = $conn -> real_escape_string($_POST['shareCode']);
      $pid = $_SESSION['pid'];

      $sql = "SELECT note FROM _shared WHERE id = $code";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
      $table = $row['note'];

      $sdb = 'sharedb_'.$pid;
      $sql = "INSERT INTO $sdb (shareTable,shareID) VALUES ('$table','$code')";
      $conn -> query($sql);
      $_SESSION['confirm'] = 'confirm';
      header('Location: ../../complete/write.php?pid='.$rand);
      exit;
  } else {
      header('Location: ../../function/error_confirm.php');
  }
