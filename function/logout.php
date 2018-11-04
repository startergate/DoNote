<?php
  require("../lib/sidUnified.php");
  $SID = new SID("donote");
  $SID -> loginCheck("../");
  session_destroy();

  $cookieTest1 = setcookie("sidAutorizeRikka", 0, time() - 3600, '/');
  $cookieTest2 = setcookie("sidAutorizeYuuta", 0, time() - 3600, '/');
  echo "<script>window.alert('로그아웃이 완료되었습니다.');</script>";
  echo "<script>window.location=('../index.php');</script>";
  exit;
