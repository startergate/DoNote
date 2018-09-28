<?php
  switch ($_SESSION['confirm']) {
    case 'confirm':
      unset($_SESSION['confirm']);
      $connection = "first";
      break;
    case 'confirm2':
      unset($_SESSION['confirm']);
      $connection = "redirect";
      break;
    case 'refresh':
      unset($_SESSION['confirm']);
      $connection = "refresh";
      break;
    case 'confirm':
      unset($_SESSION['confirm']);
      $connection = "confirm";
      break;
    default:
      echo "<script>window.alert('인증이 필요합니다');</script>";
      echo "<script>window.location=('./confirm.php');</script>";
      break;
  }
