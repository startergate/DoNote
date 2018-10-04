<?php
  require("../../config/config.php");
  require("../../lib/sidUnified.php");
  require("../../lib/codegen.php");
  $SID = new SID;
  $SID -> loginCheck("../../");
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if ($_POST['confirm_write'] === '새로운 내용을 저장!') {
      $_POST['confirm_write'] = "";
      $name = $_POST['name'];
      $text = $_POST['text'];
      $pid = $_SESSION['pid'];

      $rand = $name.generateRenStr(10);
      $rand = md5($rand, true);
      $sdb = 'sharedb_'.$pid;
      $sql = "INSERT INTO _shared (note,id) VALUES ('$name','$text',now(),'$rand')";
      $result = $conn -> query($sql);
      $_SESSION['name'] = $name;
      $_SESSION['confirm'] = 'confirm';
      header('Location: ../complete/write.php?pid='.$rand);
      exit;
  } else {
      header('Location: ../function/error_confirm.php');
  }
