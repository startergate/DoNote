<?php
	require('../config/config.php');
	require('../lib/db.php');
	session_start();

	if ($_POST['confirm_login']) {
		if (!empty($_POST['id'])) {
			if (!empty($_POST['pw'])) {
				$id = $_POST['id'];
			  $pw_temp = $_POST['pw'];

				$pw = hash("sha256",$pw_temp);
				$conn = db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
				$result = mysqli_query($conn, "SELECT * FROM donote_ahlpa_userinfo");

				$sql = "SELECT id,pw,nickname,pid FROM donote_ahlpa_userinfo WHERE id LIKE '$id'";	//user data select
			  $result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);

				$sqlid = $row['id'];
			  $hash = $row['pw'];
				$sqlni = $row['nickname'];
			  $sqlpid = $row['pid'];

				if ($id === $sqlid) {
			    if ($pw === $hash) {
						$_SESSION['pid'] = $sqlpid;
						$_SESSION['nickname'] = $sqlni;
						header('Location: ../note.php');
			    } else {
						echo "<script>window.alert('가입되지 않은 아이디이거나 틀린 비밀번호를 입력하셨습니다. 다시 로그인 해주세요.');</script>";
						echo "<script>window.location=('../login.php');</script>";
					}
			  } else {
					echo "<script>window.alert('가입되지 않은 아이디이거나 틀린 비밀번호를 입력하셨습니다. 다시 로그인 해주세요.');</script>";
					echo "<script>window.location=('../login.php');</script>";
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
