<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="../css/master.css">
  	<link rel="stylesheet" type="text/css" href="../css/list.css">
  	<link rel="stylesheet" type="text/css" href="../css/Normalize.css">
    <style media="screen">
      .n<?=$_GET['id']?> {
        background-color: #f5f5f5
      }
      .n<?=$_GET['id']?>:hover {
        background-color: #ededed
      }
    </style>
    <base target="_parent" />
  </head>
  <body style="margin: 0;">
    <ol class="nav list-group" nav-stacked="" nav-pills="">
      <?php
        require '../lib/sid.php';
        require '../config/config.php';
        $SID = new SID('donote');
        $SID->loginCheck('../');
        $conn = new mysqli($config['host'], $config['duser'], $config['dpw'], $config['dname']);  //Note Database
        session_start();

        // DoNote Share(list) Function
        $sqls = 'SELECT * FROM sharedb_'.$_SESSION['sid_pid'];
        $results = $conn->query($sqls);

        $result = $conn->query('SELECT id,name,category FROM notedb_'.$_SESSION['sid_pid'].' GROUP BY category, align, id, name');
        $row = $result->fetch_assoc();
        if (!$row) {
            echo '<li class="donoteLister list-group-item" style="padding-left: 15px;padding-top:10px;padding-bottom:10px">작성된 노트가 없습니다.</li><hr class="hrControlNote">';
        } else {
            $myShared = [];
            while ($rows = $results->fetch_assoc()) {
                if (explode('_', $rows['shareTable'])[0] === $_SESSION['sid_pid']) {
                    $myShared[] = $rows['shareTable'];
                }
            }
            $categoryid = '';
            $category = '';
            do {
                if ($categoryid != $row['category']) {
                    $categoryid = $row['category'];
                    $sqlc = "SELECT metadata FROM metadb_" . $_SESSION['sid_pid'] . " WHERE metaid = '$categoryid'";
                    $resultc = $conn->query($sqlc);
                    $rowc = $resultc->fetch_assoc();
                    $category = $rowc['metadata'];
                    echo "<div class='donoteIdentifier' style=''>$category</div><hr class='hrControlNote'>";
                }
                $isShared = '';
                $isSharedBorder = '';
                if (in_array($_SESSION['sid_pid'].'_'.$row['id'], $myShared)) {
                    $isShared = "<span class='badge donoteBadge' style='z-index:1'>공유중</span>";
                    $isSharedBorder = ' donoteBadgeBorder';
                    $rowsn = null;
                }
                echo '<li class="donoteLister list-group-item n'.$row['id'].'">'.$isShared.'<div><a class="donoteListerA'.$isSharedBorder.'" style="z-index:0" href="../note.php?id='.$row['id'].'">'.$row['name'].'</div></li></a><hr class="hrControlNote">';
            } while ($row = $result->fetch_assoc());
        }
      ?>
      <li class="donoteLister"><a href="../write.php">페이지 추가하기</li></a><hr class="hrControlNote"> <!-- 디자인 변경필요 -->
      <div class="donoteIdentifier">공유받은 페이지</div><hr class="hrControlNote">
      <?php
        $results = $conn->query($sqls);
        $rows = $results->fetch_assoc();
        if (!$rows) {
            NOSHARED:
            echo '<li style="padding-left: 15px;padding-top:10px;padding-bottom:10px">공유 받은 항목이 없습니다.</li><hr class="hrControlNote">';
        } else {
            $counter = 0;
            do {
                $noteData = explode('_', $rows['shareTable']);
                if ($noteData[0] === $_SESSION['sid_pid']) {
                    continue;
                }

                $resultsn = $conn->query('SELECT * FROM _shared WHERE id LIKE \''.$rows['shareID']."'");
                $rowsn = $resultsn->fetch_assoc();
                if (!$rowsn) {
                    $sqlsd = 'DELETE FROM sharedb_'.$_SESSION['sid_pid'].' WHERE shareID LIKE \''.$rows['shareID'].'\'';
                    $conn->query($sqlsd);
                    continue;
                }

                $counter++;
                $sqle = 'SELECT name FROM notedb_'.$noteData[0]." WHERE id LIKE '".$noteData[1]."'";
                $resulte = $conn->query($sqle);
                $rowe = $resulte->fetch_assoc();
                if ($rows['shareEdit'] === '1') {
                    echo '<li class="donoteLister list-group-item"><a class="donoteListerA" href="../note.php?id='.$rows['shareID'].'&mod=shareEdit">'.$rowe['name'].'</li></a><hr class="hrControlNote">';
                } else {
                    echo '<li class="donoteLister list-group-item"><a class="donoteListerA" href="../note.php?id='.$rows['shareID'].'&mod=shareView">'.$rowe['name'].'</li></a><hr class="hrControlNote">';
                }
            } while ($rows = $results->fetch_assoc());
            if ($counter === 0) {
                goto NOSHARED;
            }
        }
      ?>
      <li><a href="../share/add.php">코드 추가하기</li></a><hr class="hrControlNote">
    </ol>
  </body>
</html>
