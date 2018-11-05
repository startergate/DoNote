<?php
  // SID LIBRARY
  // ------------------------------------------------------
  // Copyright by 2017 ~ 2018 STARTERGATE
  // This library follows CC BY-SA 4.0. Please refer to ( https://creativecommons.org/licenses/by-sa/4.0/ )
 class SID
 {
     private $clientName;

     public function __constructor(String $clientName)
     {
         $this -> $clientName = $clientName;
     }

     public function profileGet($pid, $locater)
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         $sql = "SELECT profile_img FROM userdata WHERE pid LIKE '".$pid."'";
         $result = $conn -> query($sql);
         $row = $result -> fetch_assoc();
         if (empty($row['profile_img'])) {
             $profileImg = $locater."/static/img/common/donotepfo.png";
         } else {
             $profileImg = $locater.$row['profile_img'];
         }
         return $profileImg;
     }

     public function loginCookie($pw, $pid, $locater)
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         unset($_COOKIE['sidAutorizeRikka']);
         unset($_COOKIE['sidAutorizeYuuta']);
         $cookie_raw = generateRenStr(10);
         $cookie_data = hash("sha256", $pw);
         $sql = "UPDATE userdata SET autorize_tag='$cookie_raw' WHERE pid = '$pid'";
         $conn -> query($sql);
         $cookieTest1 = setcookie("sidAutorizeRikka", $cookie_raw, time() + 86400 * 30, $locater);
         $cookieTest2 = setcookie("sidAutorizeYuuta", $cookie_data, time() + 86400 * 30, $locater);
         return $cookieTest1 && $cookieTest2;
     }

     public function authCheck()
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         $returnRes = 0;
         if (!empty($_COOKIE['sidAutorizeRikka'])) {
             $sql = "SELECT pw,nickname,pid FROM userdata WHERE autorize_tag = '".$_COOKIE["sidAutorizeRikka"]."'";
             $result = $conn -> query($sql);
             $row = $result -> fetch_assoc($result);
             $pw_hash = hash('sha256', $row['pw']);
             if ($pw_hash === $_COOKIE['sidAutorizeYuuta']) {
                 $_SESSION['nickname'] = $row['nickname'];
                 $_SESSION['pid'] = $row['pid'];
                 $returnRes++;
             }
         }
         return $returnRes;
     }

     public function loginCheck($target)
     {
         ob_start();
         session_start();
         if (empty($_SESSION['pid'])) {
             header("Location: ".$target);
             exit;
         }
         return 1;
     }

     public function login($id, $pw)
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         $pw = hash("sha256", $pw);
         $sql = "SELECT id,pw,nickname,pid FROM userdata WHERE id LIKE '$id'";	//user data select
         $result = $conn -> query($sql);
         $row = $result -> fetch_assoc();
         $sqlpid = $row['pid'];
         if ($id === $row['id'] && $pw === $row['pw']) {
             $_SESSION['pid'] = $row['pid'];
             $_SESSION['nickname'] = $row['nickname'];
             if ($this -> checkExist($clientName.+"_additional", "pid", $pid)) {
                 $sql = "INSERT INTO $clientName.+'_additional' (pid) VALUES($pid)";
                 $conn -> query($sql);
             }
             $output = 1;
         } else {
             $output = 0;
         }
         return $output;
     }

     public function register(String $id, String $pw, String $nickname = "")
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         $checkExist = $this -> checkExist("userdata", "id", $id);
         if ($checkExist === -1) {
             return $checkExist;
         }
         if (!$nickname) {
             $nickname = $_POST['id'];
         }
         $pid = $id.$pw.$id;
         $pw = hash("sha256", $pw);
         do {
             $pid = md5($pid);
             $checkExist = $this -> checkExist("userdata", "pid", $pid);
         } while ($checkExist === -1);
         $sql = "SELECT * FROM userdata WHERE id = $id";
         $result = $conn -> query($sql);
         if ($result -> num_rows()) {
             return -1;
         }
         $sql = "INSERT INTO userdata (id,pw,nickname,register_date,pid) VALUES('".$id."','".$pw."','".$nickname."',now(),'".$pid."')";
         $conn -> query($sql);

         return $pid;
     }

     private function checkExist(String $targetDB, String $targetName, mixed $targetValue)
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         $sql = "SELECT * FROM $targetDB WHERE $targetName = $targetValue";
         $result = $conn -> query($sql);
         if ($result -> num_rows()) {
             return -1;
         }
     }

     public function passwordEdit(String $pw, String $pwr, String $pid)
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         $pwh = hash("sha256", $pw);
         $pid = $_SESSION['pid'];
         if (!$pw) {
             return -1;
             exit;
         } elseif ($pw === $pwr) {
             $sql = "UPDATE userdata SET pw='$pwh' WHERE pid='$pid'";
             $conn -> query($sql);
             return 1;
         } else {
             return 0;
             exit;
         }
     }

     public function infoEdit(String $nickname, String $currentNickname, String $pid)
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         $nickname = $conn -> real_escape_string($nickname);
         if ($nickname === $currentNickname) {
             return 0;
         } elseif ($nickname === '') {
             $nk = '사용자';
         }
         $sql = "UPDATE userdata SET nickname='$nickname' WHERE pid='$pid'";
         $conn -> query($sql);
         $_SESSION['nickname'] = $nickname;
         return 1;
     }

     public function passwordCheck(String $password, String $pid)
     {
         $conn = new mysqli("sid.donote.co", "root", "Wb4H9nn542", "sid_userdata");
         $password = hash("sha256", $password);
         $sql = "SELECT pw FROM userdata WHERE pid LIKE '$pid'";	//user data select
         $result = $conn -> query($sql);
         $row = $result -> fetch_assoc();
         if ($password === $row['pw']) {
             return 1;
         } else {
             return 0;
         }
     }
 }
