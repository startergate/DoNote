<?php
  require("../lib/sidUnified.php");
  $SID = new SID;
  $SID -> loginCheck("../");
  session_destroy();

  $cookieTest1 = setcookie("donoteAutorizeRikka", 0, time() - 3600, '/donote');
  $cookieTest2 = setcookie("donoteAutorizeYuuta", 0, time() - 3600, '/donote');
  echo "<script>window.alert('로그아웃이 완료되었습니다.');</script>";
  echo "<script>window.location=('../index.php');</script>";
  exit;
