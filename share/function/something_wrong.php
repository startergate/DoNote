<title>Redirecting...</title>
<?php
  require '../../lib/sidUnified.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  if ($_SESSION['confirm'] === 'error') {
      unset($_SESSION['confirm']);
      echo "<script>window.alert('존재하지 않는 코드입니다.');</script>";
      echo '<script>window.location=("../add.php");</script>';
      exit;
  } else {
      header('Location: ../add.php');
  }
?>
