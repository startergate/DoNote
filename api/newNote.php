<?php
  require("../config/config.php");
  require("../lib/codegen.php");
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
  header('Access-Control-Max-Age: 3600');
  header('Access-Control-Allow-Headers: Origin,Accept,X-Requested-With,Content-Type,Access-Control-Request-Method,Access-Control-Request-Headers,Authorization');
  header('Content-Type: application/json');
  $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  //Note Database
  if (empty($_POST['name'])) {
      $name = "제목 없는 노트";
  } else {
      $name = $conn -> real_escape_string($_POST['name']);
  }
  if (!empty($_POST['text'])) {
      $text = $conn -> real_escape_string($_POST['text']);
      $pid = $_POST['pid'];

      $rand = $name.generateRenStr(10);
      $rand = md5($rand, false);
      $udb = 'notedb_'.$pid;
      $sql = "INSERT INTO $udb (name,text,edittime,id) VALUES ('$name','$text',now(),'$rand')";
      $result = $conn -> query($sql);
      echo urldecode(json_encode(array("pid"=>$rand)));
      exit;
  } else {
      echo urldecode(json_encode(array("error"=>1)));
  }
