<?php
    require('../config/config_aco.php');
    require('../lib/db.php');
    require('../lib/codegen.php');
    require('../lib/sidUnified.php');

    session_start();

    if ($_POST['confirm_login']) {
        if (!empty($_POST['id'])) {
            if (!empty($_POST['pw'])) {
                $conn_n = db_init($confign["host"], $confign["duser"], $confign["dpw"], $confign["dname"]);
                $id = $_POST['id'];
                $pw = hash("sha256", $_POST['pw']);

                $sql = "SELECT id,pw,nickname,pid FROM userdata WHERE id LIKE '$id'";	//user data select
                $result = $conn_n -> query($sql);
                $row = $result -> fetch_assoc();
                $sqlpid = $row['pid'];
                if ($_POST['id'] === $row['id']) {
                    if ($pw === $row['pw']) {
                        if ($_POST['auto'] === "on") {
                            loginCookie($pw, $sqlpid, $conn_n, "/donote");
                        }
                        $_SESSION['pid'] = $row['pid'];
                        $_SESSION['nickname'] = $row['nickname'];
                        header('Location: ../note.php');
                        exit;
                    } else {
                        echo "<script>window.alert('가입되지 않은 아이디이거나 틀린 비밀번호를 입력하셨습니다. 다시 로그인 해주세요.');</script>";
                    }
                } else {
                    echo "<script>window.alert('가입되지 않은 아이디이거나 틀린 비밀번호를 입력하셨습니다. 다시 로그인 해주세요.');</script>";
                }
            } else {
                echo "<script>window.alert('비밀번호가 입력되지 않았습니다.');</script>";
            }
        } else {
            echo "<script>window.alert('아이디가 입력되지 않았습니다.');</script>";
        }
    } else {
        header('Location: ./error_confirm.php');
    }
    echo "<script>window.location=('../index.php');</script>";
