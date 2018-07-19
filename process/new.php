<?php
  require("../config/config.php");
  require("../lib/db.php");
  require("../lib/logchk2.php");
  require("../lib/codegen.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if ($_POST['confirm_write'] === '새로운 내용을 저장!') {
      $_POST['confirm_write'] = "";
      if (!empty($_POST['name'])) {
          if (!empty($_POST['text'])) {
              $name = $conn -> real_escape_string($_POST['name']);
              $text = $conn -> real_escape_string($_POST['text']);
              $pid = $_SESSION['pid'];

              $rand = $name.generateRenStr(10);
              $rand = md5($rand, false);
              $udb = 'notedb_'.$pid;
              $sql = "INSERT INTO $udb (name,text,edittime,id) VALUES ('$name','$text',now(),'$rand')";
              $result = $conn -> query($sql);
              $_SESSION['name'] = $name;
              $_SESSION['confirm'] = 'confirm';
              header('Location: ../complete/write.php?pid='.$rand);
              exit;
          } else {
              echo "<script>window.alert('본문이 입력되지 않았습니다.');</script>";
              echo "<script>window.location=('../write.php');</script>";
              exit;
          }
      } else {
          echo "<script>window.alert('제목이 입력되지 않았습니다.');</script>";
          echo "<script>window.location=('../write.php');</script>";
          exit;
      }
  } else {
      header('Location: ../function/error_confirm.php');
  }
