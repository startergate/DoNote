<?php
  require("../lib/sidUnified.php");
  loginCheck("../");
  ob_start();
  session_start();
  if ($_SESSION['confirm_edit'] === 'confirm') {
      $_SESSION['confirm_edit'] = '';
      echo "<script>window.alert('수정이 완료되었습니다.');</script>";
      echo "<script>window.location=('../note.php?id=".$_GET['id']."');</script>";
      exit;
  } else {
      $_SESSION['confirm_edit'] = '';
      header('Location: ../function/error_confirm.php');
  }
