<?php
  require("../../config/config.php");
  require("../../lib/sidUnified.php");
  require("../../lib/codegen.php");
  $SID -> loginCheck("../../");
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if ($_POST['confirm_code'] === '확인') {
      $code = $_POST['shareCode'];
      $pid = $_SESSION['pid'];

      $sql = "SELECT note FROM _shared WHERE id = $code";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
      $table = $row['note'];

      $tableExplode = explode('_', $table);

      $targetSdb = 'sharedb_'.$targetExplode[1];
      $sql = "SELECT shareTF FROM $targetSdb WHERE shareID = $code";
      $result = $conn -> query($sql);
      $row = $result -> fetch_assoc();
      if ($row['shareTF' = 0]) {
        echo "<script>window.alert('올바르지 않은 코드입니다.');</script>";
        echo "<script>window.location=('../accept.php');</script>";
        exit;
      } else {
        $sdb = 'sharedb_'.$pid;
        $sql = "INSERT INTO $sdb (shareTable,shareID,shareTF) VALUES ('$table','$code', 1)";
        $result = $conn -> query($sql);
        $_SESSION['confirm'] = 'confirm';
        header('Location: ../../complete/shareAccept.php?pid='.$rand);
        exit;
      }
  } else {
      header('Location: ../../function/error_confirm.php');
  }
