<?php
  ob_start();
  session_start();
  if($_SESSION['pid'] == "") {
    echo "<script>window.alert('로그인이 필요합니다.');</script>";
    echo "<script>window.location=('./login.php');</script>";
    exit;
  } else {
    echo "<script>window.alert('삭제가 완료되었습니다.');</script>";
    echo "<script>window.location=('../note.php');</script>";
    exit;
  }
?>
