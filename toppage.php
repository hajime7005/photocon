
<?php
if(isset($_POST['logout'])) {
    session_start();

    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
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
    <input type="button" value="ログイン" onClick="location.href='./html/login.html'"><br>

    <?php
}else{
    ?>
    <form action="toppage.php" method="post">
        <input type="submit" name="logout" value="ログアウト" /><br>
    </form>
    <?php
}
?>

<?php
if ($logined){
    ?>
    <a href="php/mypage.php">マイページ</a><BR>
    <?php
}
?>


<br>
<a href="dummy/divelopperlogin.php">開発用ログイン</a>
</body>
</html>



