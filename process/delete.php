<?php
  require '../config/config.php';
  require '../lib/sidUnified.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);
  if ($_POST['confirm_delete'] === '삭제!') {
      $id = $_GET['id'];
      $udb = 'notedb_'.$_SESSION['pid'];
      $sql = "DELETE FROM $udb WHERE id='$id'";
      $result = $conn->query($sql);
      $_SESSION['confirm_delete'] = 'confirm';
      header('Location: ../complete/delete.php?id='.$id);
  } else {
      header('Location: ../function/error_confirm.php');
  }
