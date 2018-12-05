<?php
  require("../config/config.php");
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
  header('Access-Control-Max-Age: 3600');
  header('Access-Control-Allow-Headers: Origin,Accept,X-Requested-With,Content-Type,Access-Control-Request-Method,Access-Control-Request-Headers,Authorization');
  header('Content-Type: application/json');
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  //Note Database
  $sql = "SELECT name,text FROM notedb_".$_POST['pid']." WHERE id LIKE '".$_POST['id']."'";
  $result = $conn -> query($sql);
  $output = json_encode($result -> fetch_assoc());
  echo urldecode($output);
