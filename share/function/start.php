<?php
  require("../../config/config.php");
  require("../../lib/sidUnified.php");
  require("../../lib/codegen.php");
  $SID = new SID('donote');
  $SID -> loginCheck("../../");
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if ($_POST['confirm_start'] === '확인!') {
      $sql = "SELECT name FROM notedb_".$_SESSION['pid']." WHERE id = '".$_GET['id']."'";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
      $name = $row['name'];

      $rand;
      $pid = $_SESSION['pid'];
      do {
          $rand = $name.generateRenStr(10);
          $rand = md5($rand);
          $sql = "SELECT * FROM _shared WHERE id = '$rand'";
          $result = $conn -> query($sql);
      } while ($result -> fetch_assoc());
      $id = $conn->real_escape_string($_GET['id']);
      $table = $pid.$id;
      $sql = "INSERT INTO _shared (note,id) VALUES ('$table','$rand')";
      echo $sql;
      $conn -> query($sql);
      $sdb = 'sharedb_'.$pid;
      $sql = "INSERT INTO $sdb (shareTable,shareID) VALUES ('$table','$rand')";
      echo $sql;
      $conn -> query($sql);
      $_SESSION['confirm'] = 'confirm';
      header('Location: ../../complete/write.php?pid='.$rand);
      exit;
  } else {
      header('Location: ../../function/error_confirm.php');
  }
