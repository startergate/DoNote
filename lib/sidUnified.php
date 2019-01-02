<?php
  // SID LIBRARY
  // ------------------------------------------------------
  // Copyright by 2017 ~ 2018 STARTERGATE
  // This library follows CC BY-SA 4.0. Please refer to ( https://creativecommons.org/licenses/by-sa/4.0/ )
  class SID
  {
      private $clientName;

      // Construct and Destruct Function
      public function __construct()
      {
          if (func_get_args()) {
              $this->clientName = func_get_args()[0];

              return 1;
          } else {
              return self::__destruct();
          }
      }

      public function __destruct()
      {
          $_SESSION['SID_DEBUG'] = 0x00;

          return 0;
      }

      // Login functions
      public function login($id, $pw)
      {
          try {
              $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');
              $id = $conn->real_escape_string($id);
              $pw = hash('sha256', $pw);
              $sql = "SELECT pw,nickname,pid FROM userdata WHERE id LIKE '$id'";	//user data select
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              $sqlpid = $row['pid'];
              if ($pw === $row['pw']) {
                  $output = 1;
                  $_SESSION['pid'] = $row['pid'];
                  $_SESSION['nickname'] = strip_tags($row['nickname']);
                  if (!($this->checkExist($this->clientName.'_additional', 'pid', $row['pid']))) {
                      $sql = 'INSERT INTO '.$this->clientName."_additional (pid) VALUES ('".$row['pid']."')";
                      $conn->query($sql);
                      $output++;
                  }

                  return $output;
              } else {
                  $output = 0;
              }

              return $output;
          } catch (\Exception $e) {
              return -1;
          }
      }

      public function logout()
      {
          session_destroy();

          setcookie('sidAutorizeRikka', 0, time() - 3600, '/');
          setcookie('sidAutorizeYuuta', 0, time() - 3600, '/');

          return 1;
      }

      public function register(String $id, String $pw, String $nickname = 'User')
      {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');
          $id = $conn->real_escape_string($id);
          $nickname = $conn->real_escape_string($nickname);
          if ($this->checkExist('userdata', 'id', $id) === 1) {
              return -1;
          }
          if ($nickname === '') {
              $nickname = $_POST['id'];
          }
          $pid = $id.$pw.$id;
          $pw = hash('sha256', $pw);
          do {
              $pid = md5($pid);
              $checkExist = $this->checkExist('userdata', 'pid', $pid);
          } while ($checkExist === 1);

          try {
              $sql = "INSERT INTO userdata (id,pw,nickname,register_date,pid) VALUES('".$id."','".$pw."','".$nickname."',now(),'".$pid."')";

              if ($conn->query($sql)) {
                  $sql = 'INSERT INTO '.$this->clientName."_additional (pid) VALUES ('".$pid."')";
                  $conn->query($sql);

                  return $pid;
              } else {
                  return 0;
              }
          } catch (\Exception $e) {
              return -1;
          }
      }

      // User Info Getter
      public function getUserNickname($pid)
      {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');

          try {
              $sql = 'SELECT nickname FROM userdata WHERER pid = "'.$pid.'"';
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              if ($row) {
                  return $row['nickname'];
              } else {
                  return '';
              }
          } catch (\Exception $e) {
              return '';
          }
      }

      // Auto login cookie functions
      public function loginCookie($pw, $pid, $locater)
      {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');
          unset($_COOKIE['sidAutorizeRikka']);
          unset($_COOKIE['sidAutorizeYuuta']);
          $pid = $conn->real_escape_string($pid);
          $cookie_raw = $this->generateRenStr(10);
          $cookie_data = hash('sha256', $pw);

          try {
              $sql = "UPDATE userdata SET autorize_tag='$cookie_raw' WHERE pid = '$pid'";
              $conn->query($sql);
          } catch (\Exception $e) {
              return -1;
          }
          $cookieTest1 = setcookie('sidAutorizeRikka', $cookie_raw, time() + 86400 * 30, $locater);
          $cookieTest2 = setcookie('sidAutorizeYuuta', $cookie_data, time() + 86400 * 30, $locater);

          return $cookieTest1 && $cookieTest2;
      }

      public function authCheck()
      {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');
          $returnRes = 0;
          if (!empty($_COOKIE['sidAutorizeRikka'])) {
              $sql = "SELECT pw,nickname,pid FROM userdata WHERE autorize_tag = '".$_COOKIE['sidAutorizeRikka']."'";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              $pw_hash = hash('sha256', $row['pw']);
              if ($pw_hash === $_COOKIE['sidAutorizeYuuta']) {
                  $_SESSION['nickname'] = $row['nickname'];
                  $_SESSION['pid'] = $row['pid'];
                  $returnRes++;
              }
          }

          return $returnRes;
      }

      // Information editor
      public function passwordEdit(String $pw, String $pwr, String $pid)
      {
          if (!$pw) {
              return -1;
              exit;
          } elseif ($pw === $pwr) {
              $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');
              $pw = hash('sha256', $pw);
              $pid = $_SESSION['pid'];

              try {
                  $sql = "UPDATE userdata SET pw='$pw' WHERE pid='$pid'";
                  $conn->query($sql);
              } catch (\Exception $e) {
                  return -1;
              }

              return 1;
          } else {
              return 0;
              exit;
          }
      }

      public function infoEdit(String $nickname, String $currentNickname, String $pid)
      {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');
          $nickname = $conn->real_escape_string($nickname);
          if ($nickname === $currentNickname) {
              return 0;
          } elseif ($nickname === '') {
              $nickname = 'User';
          }

          try {
              $sql = "UPDATE userdata SET nickname='$nickname' WHERE pid='$pid'";
              $conn->query($sql);
          } catch (\Exception $e) {
              return -1;
          }
          $_SESSION['nickname'] = $nickname;

          return 1;
      }

      // Editional checking functions
      public function loginCheck($target)
      {
          ob_start();
          session_start();
          if (empty($_SESSION['pid'])) {
              header('Location: '.$target);
              exit;
          }

          return 1;
      }

      private function checkExist(String $targetDB, String $targetName, String $targetValue)
      {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');

          try {
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

      public function passwordCheck(String $pw, String $pid)
      {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');
          $pw = hash('sha256', $pw);

          try {
              $sql = "SELECT pw FROM userdata WHERE pid LIKE '$pid'";	//user data select
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              if ($pw === $row['pw']) {
                  return 1;
              } else {
                  return 0;
              }
          } catch (\Exception $e) {
              return -1;
          }
      }

      // Editional Etc functions
      public function getClientName()
      {
          return $this->$clientName;
      }

      public function profileGet($pid, $locater)
      {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');
          $row;

          try {
              $sql = "SELECT profile_img FROM userdata WHERE pid LIKE '".$pid."'";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
          } catch (\Exception $e) {
              return -1;
          }
          if (empty($row['profile_img'])) {
              $profileImg = $locater.'/static/img/common/donotepfo.png';
          } else {
              $profileImg = $locater.$row['profile_img'];
          }

          return $profileImg;
      }

      public function generateRenStr($length)
      {
          $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $rendom_str = '';
          $loopNum = $length;
          while ($loopNum--) {
              $rendom_str .= $character[mt_rand(0, strlen($character) - 1)];
          }

          return $rendom_str;
      }
  }
