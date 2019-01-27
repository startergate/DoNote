<?php
  require '../lib/sidUnified.php';
  $SID = new SID('donote');
  $SID->loginCheck('../');
  if (!$_POST['confirm_user_edit']) {
      header('Location: ./error_confirm.php');
      exit;
  }
  if (!($SID->infoEdit($_POST['nickname'], $_SESSION['nickname'], $_SESSION['pid']))) {
      if (gettype($_FILES['profile']) !== 'array') {
          $conn = new mysqli('sid.donote.co', 'root', 'Wb4H9nn542', 'sid_userdata');

          $name = $_FILES['profileimg']['name'];
          $nameArray = explode('.', $name);

          $typelist = ['png', 'PNG', 'jpg', 'JPG', 'gif', 'GIF', 'jpeg', 'JPEG', 'bmp', 'BMP'];
          if (in_array($nameArray[1], $typelist)) {
              $uploads_dir = '../static/img/common/profile/';
              $sql = "UPDATE userdata SET profile_img='$nameArray[1]' WHERE pid='".$_SESSION['pid']."'";
              $result = $conn->query($sql);
              echo $uploads_dir.$_SESSION['pid'].'.'.$nameArray[1];
              move_uploaded_file($_FILES['profileimg']['tmp_name'], $uploads_dir.$_SESSION['pid'].'.'.$nameArray[1]);
              chmod($uploads_dir.$name, 0777);
          } else {
              echo "<script>window.alert('허용되지 않는 확장자입니다.');</script>";
              echo "<script>window.location=('../user/edit_info.php');</script>";
              exit;
          }
      } else {
          echo "<script>window.alert('변경 사항이 없습니다.');</script>";
          echo "<script>window.location=('../user/edit_info.php');</script>";
          exit;
      }
  }
  $_SESSION['confirm_user_edit'] = 'confirm';
  header('Location: ../complete/edit_user_info.php');
// TODO: 분리 필요
