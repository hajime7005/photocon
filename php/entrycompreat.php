<?php

session_start();

$_SESSION["logined"] = true;
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>参加者登録完了：笑顔の写真コンテスト(仮)</title>
</head>
<body>



<?php
$db_user = "photocom";	// ユーザー名
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
//プレースホルダーを設定してSQL文を作る
    $sql = "INSERT  INTO entrant (name, usename, address, tel ) VALUES ( :name, :uname, :address, :tel  )";
//プリペアードステートメントで実行準備をする。
    $stmh = $pdo->prepare($sql);
//プレースホルダーに設定する値を指示
    $stmh->bindValue(':name',  $_POST['name'],  PDO::PARAM_STR );
    $stmh->bindValue(':uname',  $_POST['nickname'],  PDO::PARAM_STR );
    $stmh->bindValue(':address',  $_POST['address'],  PDO::PARAM_STR );
    $stmh->bindValue(':tel',  $_POST['telnum'],  PDO::PARAM_STR );
//ステートメントを実行する
    $stmh->execute();
//コミット
    $pdo->commit();

?>
    <h1>参加者登録が完了しました。</h1>

    <input type="button" value="トップページへ戻る" onClick="location.href='../toppage.php'">

<?php
} catch (PDOException $Exception) {
    $pdo->rollBack();
    print "エラー：" . $Exception->getMessage();
}
?>

</body>
</html>