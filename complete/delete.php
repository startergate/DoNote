<?php
  require("../lib/sidUnified.php");
  $SID = new SID("donote");
  $SID -> loginCheck("../");
  ob_start();
  session_start();
  if ($_SESSION['confirm_delete'] === 'confirm') {
      unset($_SESSION['confirm_delete']);
      echo "<script>window.alert('삭제가 완료되었습니다.');</script>";
      echo "<script>window.location=('../note.php');</script>";
      exit;
  } else {
      unset($_SESSION['confirm_delete']);
      header('Location: ../function/error_confirm.php');
  }
