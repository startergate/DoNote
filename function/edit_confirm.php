<?php
  require '../lib/sid.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  if ($_POST['confirm_user'] === '확인') {
      if (!empty($_POST['pw'])) {
          if ($SID->passwordCheck($_COOKIE['sid_clientid'], $_SESSION['sid_sessid'], $_POST['pw'])) {
              $_SESSION['confirm'] = 'confirm';
              header('Location: ../user/edit_info.php');
          } else {
              echo "<script>window.alert('틀린 비밀번호를 입력하셨습니다. 다시 입력해주세요.');</script>";
          }
      } else {
          echo "<script>window.alert('비밀번호가 입력되지 않았습니다');</script>";
      }
  }
  echo "<script>window.location=('../user/confirm.php');</script>";
// TODO: 분리 필요
