<?php
	require('../config/config.php');
	require('../lib/db.php');
  //require('../lib/password.php');
	$id = $_POST['id'];
  $password = $_POST['pw'];
	$conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
	$result = mysqli_query($conn, "SELECT * FROM userdata");
  $sql = "SELECT id,pw,nickname,pid FROM userdata WHERE id LIKE '$id' LIMIT 1";	//user data select
  $result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
  $sqlid = $row['id'];
  $hash = $row['pw'];
	$sqlni = $row['nickname'];
  $sqlpid = $row['pid'];
  if ($id === $sqlid) {
    if ($password === $hash) {
			session_start();
			$_SESSION['pid'] = $sqlpid;
			$_SESSION['nickname'] = $sqlni;
			header('Location: ./note.php');
    } else {
			echo 'pw is a problem!';
			echo '<br />';
			echo $password;
			echo '<br />';
			echo $hash;
		}
  } else {
		echo "<script>window.alert('가입되지 않은 아이디이거나 틀린 비밀번호를 입력하셨습니다. 다시 로그인 해주세요.');</script>";
		echo "<script>window.location=('../login/login.php');</script>";
  }
?>
