<?php
  require("../config/config.php");
  require("../config/config_aco.php");
  require("../lib/db.php");
  session_start();
  if ($_POST['confirm_register'] === '회원가입') {
      if (!empty($_POST['id'])) {
          if (!empty($_POST['pw'])) {
              if (empty($_POST['nickname'])) {
                  $nickname = $_POST['id'];
              } else {
                  $nickname = $_POST['nickname'];
              }
              $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
              $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);
              if ($_POST['pw'] === $_POST['pwr']) {
                  $_SESSION['temp'] = $_POST['id'];
                  $pw = hash("sha256", $_POST['pw']);
                  $id = $_POST['id'];
                  $pid = $_POST['id'].$_POST['pwr'].$_POST['id'];
                  $pid = md5($pid);

                  $sql = 'INSERT INTO userdata (id,pw,nickname,register_date,pid) VALUES("$id","$pw", "$nickname",now(),"$pid")';
                  $result = mysqli_query($conn_n, $sql);
                  $udb = 'notedb_'.$pid;
                  $sdb = 'sharedb_'.$pid;

                  $sql = "CREATE TABLE $sdb (shareTable VARCHAR(65) NOT NULL, shareID CHAR(32) NOT NULL, shareTF INT(1), shareMod INT(2), shareUser INT(1), shareEdit INT(1), PRIMARY KEY (shareID), UNIQUE INDEX shareTable_UNIQUE (shareTable ASC), UNIQUE INDEX shareID_UNIQUE (shareID ASC))";
                  $result = mysqli_query($conn, $sql);

                  $sql = "CREATE TABLE $udb (name LONGTEXT NOT NULL,text LONGTEXT,edittime DATETIME NOT NULL,id CHAR(32) NOT NULL, align INT(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (align))";
                  $result = mysqli_query($conn, $sql);

                  $sql = "INSERT INTO $udb (name,text,edittime,id) VALUES ('DoNote를 이용해주셔서 감사합니다.','이 웹앱은 Beta 상태입니다. 정상적으로 작동되지 않을 수 있습니다.',now(),'startergatedonotedefaultregister')";
                  $result = mysqli_query($conn, $sql);

                  $shareTable = 'startergatedonotedefaultregister_'.$pid;
                  $sql = "INSERT INTO $sdb (shareTable,shareTF) VALUES ('".$shareTable."',0)";
                  $result = mysqli_query($conn, $sql);

                  echo "<script>window.alert('회원가입이 완료되었습니다. 로그인 해주세요.');</script>";
                  echo "<script>window.location=('../index.php');</script>";
                  exit;
              } else {
                  echo "<script>window.alert('비밀번호를 정확히 재입력해주세요.');</script>";
                  echo "<script>window.location=('../index.php');</script>";
                  exit;
              }
          } else {
              echo "<script>window.alert('비밀번호가 입력되지 않았습니다.');</script>";
              echo "<script>window.location=('../index.php');</script>";
              exit;
          }
      } else {
          echo "<script>window.alert('아이디가 입력되지 않았습니다.');</script>";
          echo "<script>window.location=('../index.php');</script>";
          exit;
      }
  } else {
      header('Location: ./error_confirm.php');
      exit;
  }
