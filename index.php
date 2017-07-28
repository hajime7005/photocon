
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


<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand">笑顔の写真館</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">トップ</a></li>
            <li><a href="php/entry.html">応募者登録</a></li>

            <li>
                <?php
                if ($logined){
                    ?>
                <a href="smartPHP/smartMypage.php">マイページ</a><BR>
                    <?php
                }
                ?>
            </li>

        </ul>

            <?php
            if (!($logined)){
            ?>
                <!--ログインしていません-->
                <p class="navbar-text navbar-right">
                <a href="php/login.html" class="btn btn-default">ログイン</a>
                </p>
            <?php
            }else{
            ?>
                <!--ログインしています-->
                <form action="index.php" method="post" class="navbar-form navbar-right">
                    <input type="submit" name="logout" class="btn btn-default" value="ログアウト">
                </form>
            <?php
            }
            ?>


    </div>
</nav>

<h1>笑顔の写真館へようこそ</h1>

<br>
<br>



<?php
//一覧表示
require_once './php/connectDBTemplate.php';

try {

    $sql = "SELECT id, title, filename, usename, comment, uploaddate FROM  contributions ";
    $stmh = $pd->prepare($sql);

    //ステートメントを実行する
    $stmh->execute();
    //コミット
    $pd->commit();

?>
<div class="container-fluid">
    <div class="row row-eq-height" style="display: flex; flex-wrap:  wrap">
        <?php

    $path = 'http://'.$_SERVER["SERVER_NAME"].'/photocon/image/';
    while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
        $file = $row['filename'];
        $filename = 't_'.$row['filename'];
        $title = $row['title'];
        $comment = $row['comment'];
        $user = $row['usename'];
        print '<div class="col-xs-6 col-md-3">';
        print '<a href="'.$path.'../php/photodetail.php?photo='.$file.'&title='.$title.'&comment='.$comment.'&user='.$user
                . '" class="thumbnail" target="_blank">'
                . '<img src="'.$path.$filename.'" width="90%"></a><br>';

        print '</div>';
    }
        ?>
    </div>
</div>
<?php
} catch (PDOException $Exception) {
    $pdo->rollBack();
    print "エラー：" . $Exception->getMessage();
}
?>



<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>



