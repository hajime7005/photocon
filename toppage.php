
<?php
if(isset($_POST['logout'])) {
    session_destroy();
}
?>

<?php

session_start();

$logined = false;
if(isset($_SESSION["logined"])){
    $logined = $_SESSION["logined"];
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="ニシベ　ハジメ">
    <meta charset="UTF-8">
    <title>笑顔のの写真館(仮)</title>
</head>
<body>
<h1>笑顔の写真館へようこそ</h1>


<a href="./html/entry.html">応募者登録</a>
<br><br>

<?php
if (!($logined)){
?>
    <input type="button" value="ログイン" onClick="location.href='./html/login.html'">

    <?php
}else{
?>
    <form action="toppage.php" method="post">
        <input type="submit" name="logout" value="ログアウト" />
    </form>
<?php
}
?>


</body>
</html>