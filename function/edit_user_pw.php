<?php
  require("../lib/sidUnified.php");
  require("../config/config_aco.php");
  require("../lib/db.php");
  $SID = new SID;
  $SID -> loginCheck("../");
  if ($_POST['confirm_user_edit']) {
      $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);
      $pw = hash("sha256", $_POST['pw']);
      $pid = $_SESSION['pid'];
      if (empty($_POST['pw'])) {
          echo "<script>window.alert('변경 사항이 없습니다.');</script>";
          echo "<script>window.location=('../user/edit_pw.php');</script>";
          exit;
      } else {
          if ($_POST['pw'] === $_POST['confirm']) {
              $sql = "UPDATE userdata SET pw='$pw' WHERE pid='$pid'";
              $result = $conn_n -> query($sql);
              header('Location: ../complete/edit_user_info.php');
          } else {
              echo "<script>window.alert('비밀번호를 다시 입력해주세요.');</script>";
              echo "<script>window.location=('../user/edit_pw.php');</script>";
              exit;
          }
      }
      $_SESSION['confirm_user_edit'] = 'confirm';
      header('Location: ../complete/edit_user_info.php');
  } else {
      header('Location: ./error_confirm.php');
      exit;
  }
