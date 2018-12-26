<?php
  function generateRenStr($length)
  {
      $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $rendom_str = '';
      $loopNum = $length;
      while ($loopNum--) {
          $rendom_str .= $character[mt_rand(0, strlen($character) - 1)];
      }

      return $rendom_str;
  }
