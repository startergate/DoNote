<?php
  require("../../config/config.php");
  require("../../lib/sidUnified.php");
  require("../../lib/codegen.php");
  $SID = new SID('donote');
  $SID -> loginCheck("../../");
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if ($_POST['confirm_stop'] === '확인!') {
      $code = $_POST['shareCode'];

      $sdb = 'sharedb_'.$pid;
      $sql = "DELETE FROM _shared WHERE id='$code'";
      $conn -> query($sql);
      $sql = "DELETE FROM $sdb WHERE id='$code'";
      $conn -> query($sql);
      $_SESSION['confirm_delete'] = 'confirm';
      header('Location: ../../complete/share_stop.php');
      exit;
  } else {
      header('Location: ../../function/error_confirm.php');
  }
