<?php


try {
    $db_user = "photocon";    // ユーザー名
    $db_pass = "ju78iklo";    // パスワード
    $db_host = "localhost";    // ホスト名
    $db_name = "photocon";    // データベース名
    $db_type = "mysql";    // データベースの種類


    $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

    $pd = new PDO($dsn, $db_user, $db_pass);
    $pd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pd->beginTransaction();

    /*

    $stmh = $pd->prepare("SELECT id , pass , usename FROM userlist WHERE :usename = usename "); //SQL文
    $stmh->bindValue(':usename', $_POST["nickname"], PDO::PARAM_STR);

    $stmh->execute();
    $pd->commit();
    */

}catch(PDOException $Exception) {
    $pd -> rollBack();
    print "エラー：".$Exception -> getMessage();
    die('接続エラー :' . $Exception->getMessage());
}