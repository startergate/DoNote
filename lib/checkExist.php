<?php
  function checkExist(string $targetDB, string $targetName, $targetValue, string $valueType = 'string')
  {
      $conn = new mysqli('db.donote.co', 'root', 'Wb4H9nn542', 'donote_beta');

      try {
          if ($valueType = 'string') {
              $sql = "SELECT * FROM $targetDB WHERE $targetName = '$targetValue'";
          } else {
              $sql = "SELECT * FROM $targetDB WHERE $targetName = $targetValue";
          }
          $sql = "SELECT * FROM $targetDB WHERE $targetName = '$targetValue'";
          $result = $conn->query($sql);
          if ($result->fetch_assoc()) {
              return 1;
          } else {
              return 0;
          }
      } catch (\Exception $e) {
          return -1;
      }
  }
