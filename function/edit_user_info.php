<?php
  require("../config/config_aco.php");
  require("../lib/sidUnified.php");
  $SID = new SID("donote");
  $SID -> loginCheck("../");
  if ($_POST['confirm_user_edit']) {
      if ($SID -> infoEdit($_POST['nickname'], $_SESSION['nickname'], $_SESSION['pid'])) {
          $_SESSION['confirm_user_edit'] = 'confirm';
          header('Location: ../complete/edit_user_info.php');
      } else {
          echo "<script>window.alert('변경 사항이 없습니다.');</script>";
          echo "<script>window.location=('../user/edit_info.php');</script>";
          exit;
      }
      if (!empty($_POST['nickname'])) {
          $sql = "UPDATE userdata SET nickname='$nk' WHERE pid='$pid'";
          $result = $conn_n -> query($sql);
      }
  } else {
      header('Location: ./error_confirm.php');
      exit;
  }
// TODO: 분리 필요
