<title>Redirecting...</title>
<?php
  require("../lib/sidUnified.php");
  $SID = new SID("donote");
  $SID -> loginCheck("../");
  if ($_SESSION['confirm_delete'] === 'confirm') {
      unset($_SESSION['confirm_delete']);
      echo "<script>window.alert('공유가 취소되었습니다.');</script>";
      echo '<script>window.location=("../note.php");</script>';
      exit;
  } else {
      header('Location: ../function/error_confirm.php');
  }
?>
