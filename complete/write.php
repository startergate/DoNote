<?php
  require("../lib/sidUnified.php");
  loginCheck("../");
  if ($_SESSION['confirm'] === 'confirm') {
      unset($_SESSION['confirm']);
      echo "<script>window.alert('수정이 완료되었습니다.');</script>";
      echo '<script>window.location=("../note.php?id='.$_GET['pid'].'");</script>';
      exit;
  } else {
      header('Location: ../function/error_confirm.php');
  }
