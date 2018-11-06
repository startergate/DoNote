<?php
  require("../lib/sidUnified.php");
  $SID = new SID("donote");
  $SID -> loginCheck("../");
  if ($_POST['confirm_user_edit']) {
      switch ($SID -> passwordEdit($_POST['pw'], $_POST['confirm'], $_SESSION['pid'])) {
        case -1:
          echo "<script>window.alert('변경 사항이 없습니다.');</script>";
          echo "<script>window.location=('../user/edit_pw.php');</script>";
          break;
        case 0:
          echo "<script>window.alert('비밀번호를 다시 입력해주세요.');</script>";
          echo "<script>window.location=('../user/edit_pw.php');</script>";
          break;
        case 1:
          $_SESSION['confirm_user_edit'] = 'confirm';
          header('Location: ../complete/edit_user_info.php');
          break;
      }
  } else {
      header('Location: ./error_confirm.php');
      exit;
  }
