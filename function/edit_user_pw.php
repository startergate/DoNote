<?php
  require("../lib/logchk2.php");
  require("../config/config_aco.php");
  require("../lib/db.php");
  if ($_POST['confirm_user_edit']) {
      $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);
      $pw_temp = $_POST['pw'];
      $password = hash("sha256", $pw_temp);
      $pw = mysqli_real_escape_string($conn_n, $password);
      $pid = $_SESSION['pid'];
      if (empty($_POST['pw'])) {
          echo "<script>window.alert('변경 사항이 없습니다.');</script>";
          echo "<script>window.location=('../user/edit_pw.php');</script>";
          exit;
      }
      if (!empty($_POST['pw'])) {
          if ($_POST['pw'] === $_POST['confirm']) {
              $sql = "UPDATE userdata SET pw='$pw' WHERE pid='$pid'";
              $result = mysqli_query($conn_n, $sql);
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
