<?php
  require("../lib/logchk2.php");
  session_unset();
  session_destroy();
  echo "<script>window.alert('비정상적인 접근이 감지되었습니다. 로그아웃됩니다.');</script>";
  echo "<script>window.location=('../index.php');</script>";
  exit;
?>