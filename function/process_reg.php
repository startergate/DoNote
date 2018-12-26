<?php
  require("../lib/sidUnified.php");
  require("../config/config.php");
  session_start();
  if ($_POST['confirm_register'] === '회원가입') {
      if (!empty($_POST['id'])) {
          if (!empty($_POST['pw'])) {
              $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
              $SID = new SID("donote");
              if ($_POST['pw'] === $_POST['pwr']) {
                  $_SESSION['temp'] = $_POST['id'];
                  $pid = $SID -> register($_POST['id'], $_POST['pw'], $_POST['nickname']);
                  switch ($pid) {
                    case 0:
                      echo "<script>window.alert('오류가 발생했습니다.');</script>";
                      break;
                    case -1:
                      echo "<script>window.alert('이미 있는 아이디입니다.');</script>";
                      break;
                    default:
                      $udb = 'notedb_'.$pid;
                      $sdb = 'sharedb_'.$pid;
                      $mdb = 'metadb_'.$pid;

                      $sql = "CREATE TABLE $sdb (shareTable VARCHAR(65) NOT NULL, shareID CHAR(32) NOT NULL, shareEdit INT(1), PRIMARY KEY (shareID), UNIQUE INDEX shareTable_UNIQUE (shareTable ASC), UNIQUE INDEX shareID_UNIQUE (shareID ASC))";
                      $conn -> query($sql);

                      $sql = "CREATE TABLE $mdb (datatype VARCHAR(8) NOT NULL, metadata VARCHAR(100) NOT NULL, metaid CHAR(32) NOT NULL, PRIMARY KEY (metaid));"
                      $conn -> query($sql);

                      $rand;
                      do {
                          $rand = $name.generateRenStr(10);
                          $rand = md5($rand);
                          $sql = "SELECT * FROM _meta WHERE metaid = '$rand'";
                          $result = $conn -> query($sql);
                      } while ($result -> fetch_assoc());


                      $sql = "INSERT INTO _meta (metaid, userid) VALUES ($rand, $pid)";
                      $conn -> query($sql);

                      $sql = "INSERT INTO $mdb (datatype, metadata, metaid) VALUES ('assorter','미분류', $rand)";
                      $conn -> query($sql);

                      $sql = "CREATE TABLE $udb (name LONGTEXT NOT NULL,text LONGTEXT,edittime DATETIME NOT NULL,id CHAR(32) NOT NULL, align INT(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (align))";
                      $conn -> query($sql);

                      $sql = "INSERT INTO $udb (name,text,edittime,id) VALUES ('DoNote를 이용해주셔서 감사합니다.','이 웹앱은 Beta 상태입니다. 정상적으로 작동되지 않을 수 있습니다.',now(),'startergatedonotedefaultregister')";
                      $conn -> query($sql);

                      echo "<script>window.alert('회원가입이 완료되었습니다. 로그인 해주세요.');</script>";
                      echo "<script>window.location=('http://donote.co');</script>";
                      break;
                  }
              } else {
                  echo "<script>window.alert('비밀번호를 정확히 재입력해주세요.');</script>";
              }
          } else {
              echo "<script>window.alert('비밀번호가 입력되지 않았습니다.');</script>";
          }
      } else {
          echo "<script>window.alert('아이디가 입력되지 않았습니다.');</script>";
      }
      echo "<script>window.location=('../index.php');</script>";
      exit;
  } else {
      header('Location: ./error_confirm.php');
      exit;
  }
