



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
<div class="container-fluid">
    <div class="row row-eq-height" style="display: flex; flex-wrap:  wrap">
        <?php

    $path = 'http://'.$_SERVER["SERVER_NAME"].'/photocon/image/';
    while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
        $file = $row['filename'];
        $filename = 't_'.$row['filename'];
        print '<div class="col-xs-6 col-md-3">';
        print '<a href="'.$path.'../php/photodetail.php?photo='.$file.'" class="thumbnail" target="_blank"><img src="'.$path.$filename.'"></a><br>';

        //print '<input type="button" value="詳細" onClick="location.href=\'http://google.com\'">';
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
