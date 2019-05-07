<title>Redirecting...</title>
<?php
  require '../lib/sid.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  ob_start();
  session_start();
  if ($_SESSION['confirm_user_edit'] === 'confirm') {
      $_SESSION['confirm_user_edit'] = '';
      echo "<script>window.alert('수정이 완료되었습니다.');</script>";
      echo "<script>window.location=('../note.php');</script>";
      exit;
  } else {
      $_SESSION['confirm_user_edit'] = '';
      header('Location: ../function/error_confirm.php');
  }
?>
