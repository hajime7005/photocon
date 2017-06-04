
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ログインページ</title>
</head>
<body>

<h1>開発中</h1>


<?php
    try {


        $db_user = "photocom";	// ユーザー名
        $db_pass = "ju78iklo";	// パスワード
        $db_host = "localhost";	// ホスト名
        $db_name = "photocon";	// データベース名
        $db_type = "mysql";	// データベースの種類


        $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

        $pd = new PDO($dsn, $db_user,$db_pass);
        $pd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pd->beginTransaction();

        $stmh = $pd -> prepare("SELECT id FROM entrant WHERE :usename = usename ");
        $stmh -> bindValue(':usename', $_POST["nickname"], PDO::PARAM_STR);

        $stmh -> execute();
        $pd -> commit();

        $cnt = 0;
        while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
            $usrid = $row['id'];
            $cnt++;
        }

        if($cnt == 1){
            print 'ログインが成功しました。';
            session_start();
            $_SESSION["logined"] = true ;
            $_SESSION["usrid"] = $usrid;
            ?>
            <a href="../toppage.php">トップページへ戻る</a>
<?php
        }else{
            print 'ログインに失敗しました。';
            print '<a href="../toppage.php">トップページへ戻る</a>';
        }
/*
    $stmh = $pd -> prepare("SELECT id, name, usename, address, tel FROM entrant WHERE :usename = name,");
    $stmh -> bindValue(':usename', $_POST['nickname'], PDO::PARAM_STR);

    $stmh -> execute();
    $pd -> commit();

    while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $name = $row['name'];
    $usename = $row['usename'];
    $address = $row['address'];

    }
*/

    } catch(PDOException $Exception) {
    $pd -> rollBack();
    print "エラー：".$Exception -> getMessage();
    //die('接続エラー :' . $Exception->getMessage());
    }

?>

</body>
</html>