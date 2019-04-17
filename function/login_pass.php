<?php
  session_start();
  if (!empty($_SESSION['sid_sessid'])) {
      header('Location: ../note.php');
  }
