<?php
  function db_init($host, $duser, $dpw, $dname)
  {
      $conn = new mysqli($host, $duser, $dpw, $dname);
      return $conn;
  }
