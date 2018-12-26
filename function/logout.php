<?php
  require '../lib/sidUnified.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  $SID->logout();
  echo "<script>window.alert('로그아웃이 완료되었습니다.');</script>";
  echo "<script>window.location=('../index.php');</script>";
  exit;
