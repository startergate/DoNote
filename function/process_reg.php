<?php
  require("../config/config.php");
  require("../lib/db.php");
	session_start();
  $conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  if ($_POST['confirm_register'] === '회원가입') {
    if (!empty($_POST['id'])) {
      if (!empty($_POST['pw'])) {
        if (!empty($_POST['nickname'])) {
          $id = $_POST['id'];
          $pw_temp = $_POST['pw'];
          $pwr = $_POST['pwr'];
          $nickname = $_POST['nickname'];
          $_SESSION['temp'] = $id;
          if ($pw_temp === $pwr) {
            $pw = hash("sha256",$pw_temp);
            $pid_temp = $id.$pwr.$id;
            $pid = md5($pid_temp);

            $sql = 'INSERT INTO donote_beta_userinfo (id,pw,nickname,register_date,pid) VALUES("'.$id.'","'.$pw.'", "'.$nickname.'",now(),"'.$pid.'")';
            $result = mysqli_query($conn, $sql);

            $sql = "SELECT pid FROM donote_beta_userinfo WHERE id LIKE '".$_SESSION['temp']."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $udb = 'donote_beta_usernote_'.$pid;

            $sql = "CREATE TABLE $udb (name LONGTEXT NOT NULL,text LONGTEXT NOT NULL,edittime DATETIME NOT NULL,id INT(11) NOT NULL AUTO_INCREMENT,PRIMARY KEY (id))";
            $result = mysqli_query($conn, $sql);

            $sql = "INSERT INTO $udb (name,text,edittime) VALUES ('DoNote를 이용해주셔서 감사합니다.','이 웹앱은 Beta 상태입니다. 언제든지 초기화될 수 있습니다.',now())";
            $result = mysqli_query($conn, $sql);

            echo "<script>window.alert('회원가입이 완료되었습니다. 로그인 해주세요.');</script>";
            echo "<script>window.location=('../login.php');</script>";
            exit;
          } else {
            echo "<script>window.alert('비밀번호를 정확히 재입력해주세요.');</script>";
        		echo "<script>window.location=('../register.php');</script>";
            exit;
          }
        } else {
          echo "<script>window.alert('닉네임이 입력되지 않았습니다.');</script>";
          echo "<script>window.location=('../register.php');</script>";
          exit;
        }
      } else {
        echo "<script>window.alert('비밀번호가 입력되지 않았습니다.');</script>";
        echo "<script>window.location=('../register.php');</script>";
        exit;
      }
    } else {
      echo "<script>window.alert('아이디가 입력되지 않았습니다.');</script>";
      echo "<script>window.location=('../register.php');</script>";
      exit;
    }
  } else {
    header('Location: ./error_confirm.php');
    exit;
  }
?>
