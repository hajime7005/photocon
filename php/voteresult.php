<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>作品に投票しました！：笑顔の写真館(仮)</title>
</head>
<body>

<?php
require_once ('connectDBTemplate.php');
print $_POST['mail'];
try{

    $st = $pd->prepare("SELECT id FROM contributions WHERE filename = :photo "); //SQL文
    $st->bindValue(':photo', $_POST["photo"], PDO::PARAM_STR);
    $st->execute();
    //$pd->commit();

    foreach ($st as $row){
        $photoID = $row['id'];
    }


    $st = $pd->prepare("SELECT COUNT(*) FROM vote WHERE voter = :mail GROUP BY voter"); //SQL文
    $st->bindValue(':mail', $_POST["mail"], PDO::PARAM_STR);
    $st->execute();
    $pd->commit();
    print $colcount = $st->columnCount();   //返ってきた列数

    $colcount = 0;
    if($colcount === 0){
        //まだ投票したことがない人

        $stm = $pd->prepare("INSERT INTO vote (entryid, voter, confirm) VALUES (:entryid , :voter , FLOOR(1 + RAND() * 100000)) "); //SQL文
        $stm->bindValue(':entryid', $photoID, PDO::PARAM_STR);
        print $_POST['photo'];
        $stm->bindValue(':entryid', $_POST['mail'], PDO::PARAM_STR);
        print $_POST['mail'];
        $stm->execute();
        $pd->commit();

        $stmh = $pd->prepare("SELECT voteid, entryid, voter, confirm FROM vote WHERE entryid = :entryid, voter = :voter"); //SQL文
        $stmh->bindValue(':entryid', $photoID, PDO::PARAM_STR);
        $stmh->bindValue(':entryid', $_POST['mail'], PDO::PARAM_STR);
        $stmh->execute();
        $pd->commit();

        foreach ($stmh as $row){
            $vid = $row['voteid'];
            $eid = $row['entryid'];
            $vot = $row['voter'];
            $confirm = $row['confirm'];
        }

        $key = md5($vid.$eid.$vot);

        print '<p>初めての投票なので認証を行います</p>';
        print '<p>送信されたメールを確認してください。</p>';

        print '<a href="confirm.php?id='. $confirm . '&key='. $key .'">確認画面へ(暫定)</a>';
        print '<a href="../toppage.php">トップページへ戻る</a>';

    }elseif ($colcount >= 3){

        //すでに３作品に投票している人
        print '<p>すでに3作品以上に投票しています。</p>';
        print '<a href="../toppage.php">トップページへ戻る</a>';

    }else{
        print '<p>投票が完了しました。</p>';
        print '<a href="../toppage.php">トップページへ戻る</a>';
    }

} catch (PDOException $Exception) {
    $pdo->rollBack();
    print "エラー：" . $Exception->getMessage();
}

?>

<p>作品に投稿</p>
<br><br>

<form id="mailaddress" action="voteresult.php" method="post" >

    <p>メールアドレス：<input type="text" name="mail"></p>

    <input type="submit" value="投票する！">
</form>

</body>
</html>