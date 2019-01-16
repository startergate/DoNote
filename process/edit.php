<?php
  require '../config/config.php';
  require '../lib/sidUnified.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);
  if ($_POST['confirm_edit'] !== '수정한 내용을 저장!') {
      header('Location: ../function/error_confirm.php');
  }
  if (empty($_POST['name'])) {
      $name = '제목없는 노트';
  } else {
      $name = $conn->real_escape_string($_POST['name']);
  }
  if (!empty($_POST['text'])) {
      $text = $conn->real_escape_string($_POST['text']);
      $id = $_GET['id'];
      $pid = $_SESSION['pid'];
      if (count(explode('_', $id)) > 1) {
          $pid = explode('_', $id)[0];
          $id = explode('_', $id)[1];
          $sql = "SELECT shareEdit FROM sharedb_$pid WHERE id LIKE ".$_GET['id'];
      }
      $udb = "notedb_$pid";
      $sql = "UPDATE $udb SET name='$name', text='$text', edittime=now() WHERE id='$id'";
      $result = $conn->query($sql);
      $_SESSION['confirm_edit'] = 'confirm';
      header("Location: ../complete/edit.php?id=$id");
  } else {
      echo "<script>window.alert('본문이 입력되지 않았습니다.');</script>";
      echo "<script>window.location=('../note.php?id=".$_GET['id']."');</script>";
      exit;
  }
