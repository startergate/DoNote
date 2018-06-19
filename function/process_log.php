<?php
    require('../config/config_aco.php');
    require('../lib/db.php');
    require('../lib/codegen.php');
    session_start();

    if ($_POST['confirm_login']) {
        if (!empty($_POST['id'])) {
            if (!empty($_POST['pw'])) {
                $id = $_POST['id'];
                $pw_temp = $_POST['pw'];
                $auto = $_POST['auto'];

                $pw = hash("sha256", $pw_temp);
                $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);

                $sql = "SELECT id,pw,nickname,pid FROM userdata WHERE id LIKE '$id'";	//user data select
                $result = mysqli_query($conn_n, $sql);
                $row = mysqli_fetch_assoc($result);

                $sqlid = $row['id'];
                $hash = $row['pw'];
                $sqlni = $row['nickname'];
                $sqlpid = $row['pid'];

                if ($id === $sqlid) {
                    if ($pw === $hash) {
                        if ($auto === "on") {
                            unset($_COOKIE['donoteAutorizeRikka']);
                            unset($_COOKIE['donoteAutorizeYuuta']);
                            $cookie_raw = generateRenStr(10);
                            $cookie_data = hash("sha256", $pw);
                            $sql = "UPDATE userdata SET autorize_tag='$cookie_raw' WHERE pid = '$sqlpid'";
                            $result = mysqli_query($conn_n, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $cookieTest1 = setcookie("donoteAutorizeRikka", $cookie_raw, time() + 86400 * 30, '/donote');
                            $cookieTest2 = setcookie("donoteAutorizeYuuta", $cookie_data, time() + 86400 * 30, '/donote');
                        }
                        $_SESSION['pid'] = $sqlpid;
                        $_SESSION['nickname'] = $sqlni;
                        header('Location: ../note.php');
                        echo $auto;
                        exit;
                    } else {
                        echo "<script>window.alert('가입되지 않은 아이디이거나 틀린 비밀번호를 입력하셨습니다. 다시 로그인 해주세요.');</script>";
                        echo "<script>window.location=('../login.html');</script>";
                        exit;
                    }
                } else {
                    echo "<script>window.alert('가입되지 않은 아이디이거나 틀린 비밀번호를 입력하셨습니다. 다시 로그인 해주세요.');</script>";
                    echo "<script>window.location=('../login.html');</script>";
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
