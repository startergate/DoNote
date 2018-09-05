<?php
  require("../config/config_aco.php");
  require("../lib/sidUnified.php");
  require("../lib/db.php");
  $SID = new SID;
  $SID -> loginCheck("../");
  if ($_POST['confirm_user_edit']) {
      $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);
      $nk = $conn_n -> real_escape_string($_POST['nickname']);
      $pid = $_SESSION['pid'];
      if (empty($_POST['nickname'])) {
          echo "<script>window.alert('변경 사항이 없습니다.');</script>";
          echo "<script>window.location=('../user/edit_info.php');</script>";
          exit;
      }
      if (!empty($_POST['nickname'])) {
          $sql = "UPDATE userdata SET nickname='$nk' WHERE pid='$pid'";
          $result = $conn_n -> query($sql);
      }
      $_SESSION['confirm_user_edit'] = 'confirm';
      header('Location: ../complete/edit_user_info.php');
  } else {
      header('Location: ./error_confirm.php');
      exit;
  }
