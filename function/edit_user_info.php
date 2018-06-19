<?php
  require("../lib/logchk2.php");
  require("../config/config_aco.php");
  require("../lib/db.php");
  if ($_POST['confirm_user_edit']) {
      $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);
      $nk = mysqli_real_escape_string($conn_n, $_POST['nickname']);
      $pid = $_SESSION['pid'];
      if (empty($_POST['nickname'])) {
          echo "<script>window.alert('변경 사항이 없습니다.');</script>";
          echo "<script>window.location=('../user/edit_info.php');</script>";
          exit;
      }
      if (!empty($_POST['nickname'])) {
          $sql = "UPDATE userdata SET nickname='$nk' WHERE pid='$pid'";
          $result = mysqli_query($conn_n, $sql);
      }
      $_SESSION['confirm_user_edit'] = 'confirm';
      header('Location: ../complete/edit_user_info.php');
  } else {
      header('Location: ./error_confirm.php');
      exit;
  }
