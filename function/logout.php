<?php
  require("../lib/logchk2.php");
  session_start();
  session_unset();
  session_destroy();
  echo "<script>window.alert('로그아웃이 완료되었습니다.');</script>";
  echo "<script>window.location=('../login.php');</script>";
  exit;
?>
