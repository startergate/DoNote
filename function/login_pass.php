<?php
  session_start();
  if (!empty($_SESSION['pid'])) {
      header('Location: ../note.php');
  }
