<?php
  function profileGet($pid, $conn, $locater)
  {
      $sql = "SELECT profile_img FROM userdata WHERE pid LIKE '".$pid."'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      if (empty($row['profile_img'])) {
          $profileImg = $locater."/static/img/common/donotepfo.png";
      } else {
          $profileImg = $locater.$row['profile_img'];
      }
      return $profileImg;
  }
