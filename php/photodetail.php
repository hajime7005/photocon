<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>写真の詳細：笑顔の写真館(仮)</title>
</head>
<body>
<?php
 $path ='http://'.$_SERVER["SERVER_NAME"].'/photocon/image/';
 $file = $_GET['photo'];
 print '<img src="'. $path . $file .'" width="80%"><br>';
 print '<p>タイトル：'.$_GET['title'].'</p>';
 print '<p>コメント：'.$_GET['comment'].'</p>';
 print '<p>投稿者：'.$_GET['user'].'</p>';
 
 print '<input type="button" onclick="location.href=\'vote.php?photo='.$file.'\'"value="投票する">';
?>
</body>
</html>