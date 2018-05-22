<?php
  require("../config/config.php");
  require("../lib/db.php");
  require("../lib/logchk2.php");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  //if ($_POST['confirm_edit'] !== '수정한 내용을 저장!') {
  //  header('Location: ../function/error_confirm.php');
  //}
  if (empty($_POST['name'])) {
      $name = "제목없는 노트";
  } else {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
  }
  if (!empty($_POST['text'])) {
      $text = $_POST['text'];
      $pid = $_SESSION['pid'];
      $id = $_GET['id'];
      $udb = 'notedb_'.$pid;
      $sql = "UPDATE $udb SET name='$name', text='$text', edittime=now() WHERE id='$id'";
      $result = mysqli_query($conn, $sql);
      $_SESSION['confirm_edit'] = 'confirm';
      header('Location: ../complete/edit.php?id='.$id);
  } else {
      echo "<script>window.alert('본문이 입력되지 않았습니다.');</script>";
      echo "<script>window.location=('../note.php?id=".$_GET['id']."');</script>";
      exit;
  }
