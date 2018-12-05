<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
  header('Access-Control-Max-Age: 3600');
  header('Access-Control-Allow-Headers: Origin,Accept,X-Requested-With,Content-Type,Access-Control-Request-Method,Access-Control-Request-Headers,Authorization');
  header('Content-Type: application/json');
  try {
      require("../config/config.php");
      $conn = new mysqli($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
      $udb = 'notedb_'.$_POST['pid'];
      $name = $_POST['name'];
      $sql = "SELECT * FROM $udb WHERE name='$name'";
      $result = $conn -> query($sql);
      if ($row = $result -> fetch_assoc()) {
          echo urldecode(json_encode(array("id"=>$row['id'], "error"=>0)));
      } else {
          echo urldecode(json_encode(array("id"=>0, "error"=>0)));
      }
  } catch (\Exception $e) {
      echo urldecode(json_encode(array("error"=>1)));
  }
