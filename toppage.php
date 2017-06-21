
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
    <title>笑顔のの写真館(仮)</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<!-- 1.ナビゲーションバーの設定 -->
<nav class="navbar navbar-default">
    <div class="container">
        <!-- 2.ヘッダ情報 -->
        <div class="navbar-header">
            <a class="navbar-brand">笑顔の写真館</a>
        </div>
        <!-- 3.リストの配置 -->
        <ul class="nav navbar-nav">
            <li class="active"><a href="toppage.php">トップ</a></li>
            <li><a href="./html/entry.html">応募者登録</a></li>

            <li>
                <?php
                if ($logined){
                    ?>
                    <a href="php/mypage.php">マイページ</a><BR>
                    <?php
                }
                ?>
            </li>

        </ul>

            <?php
            if (!($logined)){
                ?>

                <p class="navbar-text navbar-right">
                <a href="./html/login.html" class="btn btn-default">ログイン</a>
                </p>
                <?php
            }else{
            ?>
            <form action="toppage.php" method="post" class="navbar-form navbar-right">
                <input type="submit" name="logout" class="btn btn-default" value="ログアウト">
            </form>
            <?php
            }
            ?>


    </div>
</nav>

<h1>笑顔の写真館へようこそ</h1>

<!--
<a href="dummy/divelopperlogin.php">開発用ログイン</a>
-->
<br>
<br>

<?php
require_once('./dummy/allview.php');
?>


<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>



