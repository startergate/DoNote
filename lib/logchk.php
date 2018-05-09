<?php
  ob_start();
  session_start();
  if (empty($_SESSION['pid'])) {
    echo "<script>window.alert('로그인이 필요합니다.');</script>";
    echo "<script>window.location=('./login.html');</script>";
  exit;
  }
?>
