<?php
  require("../../config/config.php");
  require("../../lib/sidUnified.php");
  require("../../lib/codegen.php");
  $SID = new SID('donote');
  $SID -> loginCheck("../../");
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if ($_POST['confirm_write'] === '새로운 내용을 저장!') {
      $_POST['confirm_write'] = "";
      $rand = '';
      $pid = $_SESSION['pid'];
      do {
          $rand = $name.generateRenStr(10);
          $rand = md5($rand, true);
          $sql = "SELECT * FROM _shared WHERE id = '$rand'";
          $result = $conn -> query($sql);
      } while ($result -> fetch_assoc());
      $sdb = 'sharedb_'.$pid;
      $sql = "INSERT INTO _shared (note,id) VALUES ('$name','$rand')";
      $conn -> query($sql);
      $_SESSION['confirm'] = 'confirm';
      header('Location: ../complete/write.php?pid='.$rand);
      exit;
  } else {
      header('Location: ../function/error_confirm.php');
  }
