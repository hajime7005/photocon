



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
} catch(PDOException $Exception) {
    die('エラー :' . $Exception->getMessage());
}

try {
    $pdo->beginTransaction();

    $sql = "SELECT id, title, filename, usename, comment, uploaddate FROM  contributions ";
    $stmh = $pdo->prepare($sql);

    //ステートメントを実行する
    $stmh->execute();
    //コミット
    $pdo->commit();

    ?>
<div class="row">
    <?php

    while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
        $filename = 't_'.$row['filename'];

        ?>
    <div class="col-xs-6 col-md-3">

        <!-- xammpの場合-->
        <a href="http://localhost/qhotocon/photocon/image/<?php print $filename ?>" class="thumbnail" target="_blank">
            <img src="http://localhost/qhotocon/photocon/image/<?php print $filename ?>">
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

