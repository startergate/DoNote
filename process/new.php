<?php
  require("../config/config.php");
  require("../lib/db.php");
  require("../lib/logchk2.php");
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  if ($_POST['confirm_write'] === '새로운 내용을 저장!') {
    $_POST['confirm_write'] = "";
    if (!empty($_POST['name'])) {
      if (!empty($_POST['text'])) {
        $name = $_POST['name'];
        $text = $_POST['text'];
        $pid = $_SESSION['pid'];
        $udb = 'donote_ahlpa_userznote_'.$pid;
        $sql = "INSERT INTO $udb (name,text,edittime) VALUES ('$name','$text',now())";
        $result = mysqli_query($conn, $sql);
        $_SESSION['name'] = $name;
        $_SESSION['confirm_write'] = 'confirm';
        header('Location: ../complete/write.php');
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
?>
