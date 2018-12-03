<?php
  require("../config/config.php");
  header('Content-Type: application/json');
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  //Note Database
  $sql = "SELECT name,text FROM notedb_".$_POST['pid']." WHERE id LIKE '".$_POST['id']."'";
  $result = $conn -> query($sql);
  $output = json_encode($result -> fetch_assoc());
  echo urldecode($output);
