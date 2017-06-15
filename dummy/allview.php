

<!DOCTYPE html>
<html>
<head>
    <meta name="author" content="ニシベ　ハジメ">
    <title>写真一覧</title>

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

<?php
$db_user = "photocon";	// ユーザー名
$db_pass = "ju78iklo";	// パスワード
$db_host = "localhost";	// ホスト名
$db_name = "photocon";	// データベース名
$db_type = "mysql";	// データベースの種類


$dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

try {
    $pdo = new PDO($dsn, $db_user,$db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    print "接続しました... <br>";
} catch(PDOException $Exception) {
    die('エラー :' . $Exception->getMessage());
}

try {
    $pdo->beginTransaction();

    $sql = "SELECT filename FROM  contributions ";
    $stmh = $pdo->prepare($sql);

    //ステートメントを実行する
    $stmh->execute();
    //コミット
    $pdo->commit();


    ?>
<div class="row">
    <?php

    while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
        $filename = $row['filename'];

        ?>
    <div class="col-xs-6 col-md-3">
        <a href="../image/<?php print $filename ?>" class="thumbnail" target="_blank">
            <img src="../image/<?php print $filename ?>">
        </a>
    </div>

    <?php
    }
    ?>
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