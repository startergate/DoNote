<?php
  require '../lib/sidUnified.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  if ($SID->logout($_COOKIE['sid_clientid'], $_SESSION['sid_sessid'])) {
      echo "<script>window.alert('로그아웃이 완료되었습니다.');</script>";
      echo "<script>window.location=('../index.php');</script>";
  } else {
      http_response_code(500); // 에러 코드 발송
  }
