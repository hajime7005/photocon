<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>作品に投票する：笑顔の写真館(仮)</title>
</head>
<body>

<p>作品に投稿</p>
<br>
<?php
$path ='http://'.$_SERVER["SERVER_NAME"].'/photocon/image/';
$file = $_GET['photo'];
print '<img src="'. $path . $file .'" width="80%"><br>';
?>

<form id="mailaddress" action="voteresult.php" method="post" >
    <p>メールアドレス：<input type="text" name="mail"></p>
    <input type="submit" value="投票する！">
    <?php
    print '<INPUT type="hidden" name="photoname" value = "'.$file.'" >';
    ?>
</form>

</body>
</html>