<?php
  require("../lib/sidUnified.php");
  $SID = new SID;
  $SID -> loginCheck("../");
  session_start();
  if ($_SESSION['reconfirm'] = 'confirm') {
      $_SESSION['confirm'] = 'confirm2';
      header("Location: ".$_GET['target']);
  }
