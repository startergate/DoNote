<?php
  require '../../config/config.php';
  require '../../lib/sidUnified.php';
  $SID = new SID('donote');
  $SID->loginCheck('../../');
  $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);
  if ($_POST['confirm_code'] !== '확인') {
      header('Location: ../../function/error_confirm.php');
  }
  $code = $conn->real_escape_string($_POST['shareCode']);
  $pid = $_SESSION['pid'];

  $sql = "SELECT note FROM _shared WHERE id = '$code'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $table = $row['note'];
  if (!$row) {
      $_SESSION['confirm'] = 'error';
      header('Location: ./something_wrong.php');
  }
  $originPid = explode('_', $table)[0];
  $sql = "SELECT shareEdit FROM sharedb_$originPid WHERE shareID LIKE '$code'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $isEditable = $row['shareEdit'];
  $sdb = 'sharedb_'.$pid;
  $sql = "INSERT INTO $sdb (shareTable,shareID,shareEdit) VALUES ('$table','$code', $isEditable)";
  $conn->query($sql);
  $_SESSION['confirm'] = 'confirm';
  header('Location: ../../complete/write.php?pid='.$rand);
