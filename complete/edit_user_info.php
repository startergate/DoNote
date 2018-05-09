<?php
  ob_start();
  session_start();
  if($_SESSION['pid'] == "") {
    echo "<script>window.alert('로그인이 필요합니다.');</script>";
    echo "<script>window.location=('./login.html');</script>";
    exit;
  } else {
    if ($_SESSION['confirm_user_edit'] === 'confirm') {
      $_SESSION['confirm_user_edit'] = "";
      echo "<script>window.alert('수정이 완료되었습니다.');</script>";
      echo "<script>window.location=('../note.php');</script>";
      exit;
    } else {
      $_SESSION['confirm_user_edit'] = "";
      header('Location: ../function/error_confirm.php');
    }
  }
?>
