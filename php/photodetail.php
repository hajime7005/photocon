<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>写真の詳細：笑顔の写真館(仮)</title>
</head>
<body>
<?php
require_once 'connectDBTemplate.php';

try{

    $stmh = $pd->prepare("SELECT voteid FROM vote WHERE entryid = :entid "); //SQL文
    $stmh->bindValue(':entid', $_GET["entid"], PDO::PARAM_INT);

    $stmh->execute();
    $pd->commit();
    
    $point = $stmh->rowCount();

}catch(PDOException $Exception) {
    $pd -> rollBack();
    print "エラー：".$Exception -> getMessage();
    die('接続エラー :' . $Exception->getMessage());
}

 $path ='http://'.$_SERVER["SERVER_NAME"].'/photocon/image/';
 $file = $_GET['photo'];
 print '<img src="'. $path . $file .'" width="80%"><br>';
 print '<p>タイトル：'.$_GET['title'].'</p>';
 print '<p>コメント：'.$_GET['comment'].'</p>';
 print '<p>投稿者：'.$_GET['user'].'</p>';
 print '<p>投票ポイント：'.$point.'</p>';
 if(isset($_SESSION['logined'])){
    print '<input type="button" onclick="location.href=\'vote.php?photo='.$file.'\'"value="投票する"><br><br>';
 }
 print '<a href="../index.php">トップページへ戻る</a>';
?>
</body>
</html>