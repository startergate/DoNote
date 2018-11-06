<?php
  require('../lib/sidUnified.php');
  $SID = new SID("donote");

  session_start();

  if ($_POST['confirm_login']) {
      if (!empty($_POST['id'])) {
          if (!empty($_POST['pw'])) {
              if ($SID -> login($_POST['id'], $_POST['pw'])) {
                  if ($_POST['auto'] === "on") {
                      $SID -> loginCookie($_POST['pw'], $_SESSION['pid'], "/");
                  }
                  header('Location: ../note.php');
              } else {
                  echo "<script>window.alert('가입되지 않은 아이디이거나 틀린 비밀번호를 입력하셨습니다. 다시 로그인 해주세요.');</script>";
              }
          } else {
              echo "<script>window.alert('비밀번호가 입력되지 않았습니다.');</script>";
          }
      } else {
          echo "<script>window.alert('아이디가 입력되지 않았습니다.');</script>";
      }
  } else {
      header('Location: ./error_confirm.php');
  }
  echo "<script>window.location=('../');</script>";
