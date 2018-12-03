<?php
  require("../config/config.php");
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  if (empty($_POST['name'])) {
      $name = "제목없는 노트";
  } else {
      $name = $conn -> real_escape_string($_POST['name']);
  }
  if (!empty($_POST['text'])) {
      $text = $conn -> real_escape_string($_POST['text']);
      $id = $_POST['id'];
      $udb = 'notedb_'.$_POST['pid'];
      $sql = "UPDATE $udb SET name='$name', text='$text', edittime=now() WHERE id='$id'";
      $result = $conn -> query($sql);
      echo urldecode(json_encode(array("error"=>0)));
  } else {
      echo urldecode(json_encode(array("error"=>1)));
      exit;
  }
