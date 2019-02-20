<?php
  require '../lib/sidUnified.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  $SID->logout();
  echo "<script>window.alert('비정상적인 접근이 감지되었습니다. 로그아웃됩니다.');</script>";
  echo "<script>window.location=('../');</script>";
  exit;
