<?php
  require("../lib/logchk2.php");
  if ($_SESSION['confirm'] === 'confirm') {
    unset($_SESSION['confirm']);
    if($_SESSION['pid'] == "") {
      echo "<script>window.alert('로그인이 필요합니다.')</script>";
      echo "<script>window.location=('./login.html');</script>";
      exit;
    } else {
      echo "<script>window.alert('수정이 완료되었습니다.');</script>";
      echo '<script>window.location=("../note.php?id='.$_GET['pid'].'");</script>';
      exit;
    }
  } else {
      header('Location: ../function/error_confirm.php');
  }
?>
