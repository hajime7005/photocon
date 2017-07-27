<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>作品に投票します：笑顔の写真館(仮)</title>
</head>
<body>

<?php
require_once ('connectDBTemplate.php');
try{
    
    //メールアドレスからすでに投票したことがある人か確認
    $st1 = $pd->prepare("SELECT confirm FROM vote WHERE voter = :mail "); //SQL文
    $st1->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
    $st1->execute();  
    $lines = $st1->rowCount();
    $confirm = $st1->fetchColumn();
  
    //これから投票される写真のIDを取得
    $st2 = $pd->prepare("SELECT id FROM contributions WHERE filename = :photoname "); //SQL文
    $st2->bindValue(':photoname', $_POST['photoname'], PDO::PARAM_STR);
    $st2->execute();
    
    
    $photoID = $st2->fetchColumn();
    

    if($lines == 0){
        //まだ投票したことがない人ならば
       
        print $rand = rand(10000,99999);
        $st3 = $pd->prepare("INSERT INTO vote (entryid, voter, confirm) VALUES (:entryid , :voter , :confirm)"); //SQL文
        $st3->bindValue(':entryid', $photoID, PDO::PARAM_INT);
        $st3->bindValue(':voter', $_POST['mail'], PDO::PARAM_STR);
        $st3->bindValue(':confirm', $rand, PDO::PARAM_INT);
        $st3->execute();

        
        $st = $pd->prepare("SELECT voteid, entryid, voter, confirm FROM vote WHERE entryid = :entryid AND voter = :voter "); //SQL文
        $st->bindValue(':entryid', $photoID, PDO::PARAM_INT);
        $st->bindValue(':voter', $_POST['mail'], PDO::PARAM_STR);
        $st->execute();
        $pd->commit();

        foreach ($st as $row){
            $vid = $row['voteid'];
            $eid = $row['entryid'];
            $vot = $row['voter'];
            $confirm = $row['confirm'];
        }

        $key = md5($vid.$eid.$vot);

        print '<p>初めての投票なので認証を行います</p>';
        print '<p>送信されたメールを確認してください。</p>';

        print '<a href="confirm.php?id='. $confirm . '&key='. $key .'">確認画面へ(暫定)</a><br>';
        print '<a href="../index.php">トップページへ戻る</a>';

    }else if($lines == 3){
        
        //すでに3件投票している人の場合
        print "<p>すでに3件投票しているので、もう、投票できません</p>";
        print "<a href='../index.php'>トップページへ戻る</a>";
        
    }else if($confirm != 0){
        
        //初回投票確認を済ませていない人の場合
        $st = $pd->prepare("SELECT voteid, entryid, voter, confirm FROM vote WHERE entryid = :entryid, voter = :voter"); //SQL文
        $st->bindValue(':entryid', $photoID, PDO::PARAM_STR);
        $st->bindValue(':voter', $_POST['mail'], PDO::PARAM_STR);
        $st->execute();
        $pd->commit();

        foreach ($st as $row){
            $vid = $row['voteid'];
            $eid = $row['entryid'];
            $vot = $row['voter'];
            $confirm = $row['confirm'];
        }

        $key = md5($vid.$eid.$vot);

        print '<p>初めての投票なので認証を行います</p>';
        print '<p>送信されたメールを確認してください。</p>';

        print '<a href="confirm.php?id='. $confirm . '&key='. $key .'">確認画面へ(暫定)</a><br>';
        print '<a href="../index.php">トップページへ戻る</a>';
    
        
    }else{
        
        //初回投稿確認を済ませ、投票の数も3件未満の人の場合
        $st = $pd->prepare("INSERT INTO vote (entryid, voter, confirm) VALUES (:entryid , :voter , 0)"); //SQL文
        $st->bindValue(':entryid', $photoID, PDO::PARAM_STR);
        $st->bindValue(':voter', $_POST['mail'], PDO::PARAM_STR);
        $st->execute();
        $pd->commit();
        
        print '<p>投票が完了しました</p>';
        print '<a href="../index.php">トップページへ戻る</a>';

    }
    
} catch (PDOException $Exception) {
    $pd->rollBack();
    print "エラー：" . $Exception->getMessage();
}

?>

</body>
</html>