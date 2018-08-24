<?php
  require("../config/config.php");
  require("../lib/db.php");
  loginCheck("../");
  $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if ($_POST['confirm_delete'] === '삭제!') {
      $id = $_GET['id'];
      if ($id === 'startergatedonotedefaultregister') {
          echo "<script>window.alert('삭제할 수 없는 페이지입니다.');</script>";
          echo "<script>window.location=('../note.php');</script>";
          exit;
      }
      $udb = 'notedb_'.$_SESSION['pid'];
      $sql = "DELETE FROM $udb WHERE id='$id'";
      $result = mysqli_query($conn, $sql);
      $_SESSION['confirm_delete'] = 'confirm';
      header('Location: ../complete/delete.php?id='.$id);
  } else {
      header('Location: ../function/error_confirm.php');
  }
