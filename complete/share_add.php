<title>Redirecting...</title>
<?php
  require '../lib/sid.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  if ($_SESSION['confirm'] === 'confirm') {
      unset($_SESSION['confirm']);
      echo "<script>window.alert('추가가 완료되었습니다.');</script>";
      echo '<script>window.location=("../note.php");</script>';
      exit;
  } else {
      header('Location: ../function/error_confirm.php');
  }
?>
