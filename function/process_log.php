<?php
  require '../lib/sid.php';
  require '../lib/checkExist.php';
  require '../config/config.php';
  $SID = new SID('donote');

  session_start();

  if ($_POST['confirm_login']) {
      if (!empty($_POST['id'])) {
          if (!empty($_POST['pw'])) {
              $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);
              if ($SID->login($_COOKIE['sid_clientid'], $_POST['id'], $_POST['pw'])) {
                  if (!checkExist('_user', 'pid', $_SESSION['pid'])) {
                      $udb = 'notedb_'.$_SESSION['pid'];
                      $sdb = 'sharedb_'.$_SESSION['pid'];

                      $sql = "CREATE TABLE $sdb (shareTable VARCHAR(65) NOT NULL, shareID CHAR(32) NOT NULL, shareEdit INT(1), PRIMARY KEY (shareID), UNIQUE INDEX shareTable_UNIQUE (shareTable ASC), UNIQUE INDEX shareID_UNIQUE (shareID ASC))";
                      $conn->query($sql);

                      $sql = "CREATE TABLE $udb (name LONGTEXT NOT NULL,text LONGTEXT,edittime DATETIME NOT NULL,id CHAR(32) NOT NULL, align INT(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (align))";
                      $conn->query($sql);

                      $sql = "INSERT INTO $udb (name,text,edittime,id) VALUES ('DoNote를 이용해주셔서 감사합니다.','이 웹앱은 Beta 상태입니다. 정상적으로 작동되지 않을 수 있습니다.',now(),'startergatedonotedefaultregister')";
                      $conn->query($sql);
                  }
                  header('Location: ../note.php');
                  exit;
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
      exit;
  }
  echo "<script>window.location=('../');</script>";
