<?php
  // SID LIBRARY
  // ------------------------------------------------------
  // Copyright by 2017 ~ 2018 STARTERGATE
  // This library follows CC BY-SA 4.0. Please refer to ( https://creativecommons.org/licenses/by-sa/4.0/ )
 class SID
 {
     public function profileGet($pid, $conn, $locater)
     {
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

     public function loginCookie($pw, $pid, $conn, $locater)
     {
         unset($_COOKIE['sidAutorizeRikka']);
         unset($_COOKIE['sidAutorizeYuuta']);
         $cookie_raw = generateRenStr(10);
         $cookie_data = hash("sha256", $pw);
         $sql = "UPDATE userdata SET autorize_tag='$cookie_raw' WHERE pid = '$pid'";
         $result = $conn -> query($sql);
         $cookieTest1 = setcookie("sidAutorizeRikka", $cookie_raw, time() + 86400 * 30, $locater);
         $cookieTest2 = setcookie("sidAutorizeYuuta", $cookie_data, time() + 86400 * 30, $locater);
         return $cookieTest1 && $cookieTest2;
     }

     public function authCheck()
     {
         $returnRes = 0;
         if (!empty($_COOKIE['donoteAutorizeRikka'])) {
             $conn = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);
             $sql = "SELECT pw,nickname,pid FROM userdata WHERE autorize_tag = '".$_COOKIE["sidAutorizeRikka"]."'";
             $result = $conn -> query($sql);
             $row = $result -> fetch_assoc($result);
             $pw_hash = hash('sha256', $row['pw']);
             if ($pw_hash === $_COOKIE['donoteAutorizeYuuta']) {
                 $_SESSION['nickname'] = $row['nickname'];
                 $_SESSION['pid'] = $row['pid'];
                 $returnRes++;
             }
         }
         return $returnRes;
     }

     public function loginCheck($locater)
     {
         ob_start();
         session_start();
         if (empty($_SESSION['pid'])) {
             header("Location: ".$locater."index.php");
             exit;
         }
     }

     public function login($id, $pw, $conn)
     {
         $pw = hash("sha256", $pw);
         $sql = "SELECT id,pw,nickname,pid FROM userdata WHERE id LIKE '$id'";	//user data select
         $result = $conn -> query($sql);
         $row = $result -> fetch_assoc();
         $sqlpid = $row['pid'];
         if ($id === $row['id'] && $pw === $row['pw']) {
             $_SESSION['pid'] = $row['pid'];
             $_SESSION['nickname'] = $row['nickname'];
             $output = 1;
         } else {
             $output = 0;
         }
         return $output;
     }
 }
