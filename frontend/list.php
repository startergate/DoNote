<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="../css/master.css">
  	<link rel="stylesheet" type="text/css" href="../css/list.css">
  	<link rel="stylesheet" type="text/css" href="../css/Normalize.css">
    <base target="_parent" />
  </head>
  <body style="margin: 0;">
    <ol class="nav" nav-stacked="" nav-pills="">
      <div class="donoteIdentifier" style="">노트</div><hr class='hrControlNote'>
      <?php
        require("../lib/db.php");
        require("../config/config.php");
        $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  //Note Database
        session_start();
        // DoNote Share(list) Function
        $sqls = "SELECT shareTable,shareID FROM sharedb_".$_SESSION['pid']." WHERE shareTF = 1 AND shareMod = 2";
        $results = $conn -> query($sqls);
        $rows = $results -> fetch_assoc();
        $result = $conn -> query("SELECT id,name FROM notedb_".$_SESSION['pid']);
        while ($row = $result -> fetch_assoc()) {
            echo '<li><a class="donoteLister" href="../note.php?id='.$row['id'].'">'.$row["name"].'</li></a><hr class="hrControlNote">';
        }
      ?>
      <li><a href="../write.php">페이지 추가하기</li></a><hr class="hrControlNote">
      <div class="donoteIdentifier">공유받은 페이지</div><hr class="hrControlNote">
      <?php
        if (!$rows) {
            echo '<li style="margin-left: 15px">공유 받은 항목이 없습니다.</li><hr class="hrControlNote">';
        } else {
            do {
                $noteData = explode('_', $rows['shareTable']);
                $sqle = "SELECT name FROM notedb_".$noteData[1]." WHERE id LIKE '".$noteData[0]."'";
                $resulte = $conn -> query($sqle);
                $rowe = $resulte -> fetch_assoc();
                echo '<li><a class="donoteLister" href="../share/view.php?shareID='.$rows['shareID'].'">'.$rowe["name"].'</li></a><hr class="hrControlNote">';
            } while ($rows = $results -> fetch_assoc());
        }
      ?>
      <li><a href="../share/accept.php">코드 추가하기</li></a><hr class="hrControlNote">
    </ol>

  </body>
</html>
