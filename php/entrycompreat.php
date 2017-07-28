
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>参加者登録完了：笑顔の写真コンテスト(仮)</title>
</head>
<body>

<?php

require_once 'connectDBTemplate.php';

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

    //birthday未実装
    $sql = "INSERT  INTO userlist (name, usename, address, tel, gender, pass ) 
            VALUES ( :name, :uname, :address, :tel, :gender, :pass  )";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(':name',  $_POST['name'],  PDO::PARAM_STR );
    $stmh->bindValue(':uname',  $_POST['nickname'],  PDO::PARAM_STR );
    $stmh->bindValue(':address',  $_POST['address'],  PDO::PARAM_STR );
    $stmh->bindValue(':tel',  $_POST['telnum'],  PDO::PARAM_STR );
    $stmh->bindValue(':gender',  $_POST['gender'],  PDO::PARAM_STR );
    $passwd = $_POST['passwd'];
    $hashvalue = password_hash($passwd, PASSWORD_DEFAULT);
    $stmh->bindValue(':pass',  $hashvalue,  PDO::PARAM_STR );

    $stmh->execute();
    $pd->commit();

?>
    <h1>参加者登録が完了しました。</h1>

    <input type="button" value="トップページへ戻る" onClick="location.href='../index.php'">
    <?php
    session_start();
    $_SESSION["logined"] = true;
    $_SESSION["nickname"] = $_POST["nickname"];
    ?>
    <?php
} catch (PDOException $Exception) {
    $pdo->rollBack();
    print "エラー：" . $Exception->getMessage();
}
?>

</body>
</html>