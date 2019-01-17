<?php
  require '../../config/config.php';
  require '../../lib/sidUnified.php';
  require '../../lib/codegen.php';
  $SID = new SID('donote');
  $SID->loginCheck('../../');
  $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);
  if (empty($_GET['id']) || $_POST['confirm_start'] !== '확인!') {
      header('Location: ../../function/error_confirm.php');
  }
  $sql = 'SELECT name FROM notedb_'.$_SESSION['pid']." WHERE id = '".$_GET['id']."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $name = $row['name'];

  $rand;
  $pid = $_SESSION['pid'];
  do {
      $rand = $name.generateRenStr(10);
      $rand = md5($rand);
      $sql = "SELECT * FROM _shared WHERE id = '$rand'";
      $result = $conn->query($sql);
  } while ($result->fetch_assoc());
  $id = $conn->real_escape_string($_GET['id']);
  if ($_POST['edit'] === 'on') {
      $edit = 1;
  } else {
      $edit = 0;
  }
  $table = $pid.'_'.$id;
  $sql = "INSERT INTO _shared (note,id) VALUES ('$table','$rand')";
  $conn->query($sql);
  $sdb = 'sharedb_'.$pid;
  $sql = "INSERT INTO $sdb (shareTable,shareID, shareEdit) VALUES ('$table','$rand', $edit)";
  $conn->query($sql);
  $_SESSION['confirm'] = 'confirm';
  header('Location: ../../complete/share_start.php?pid='.$id);
  exit;
