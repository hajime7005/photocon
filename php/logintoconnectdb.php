
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


        $db_user = "photocon";	// ユーザー名
        $db_pass = "ju78iklo";	// パスワード
        $db_host = "localhost";	// ホスト名
        $db_name = "photocon";	// データベース名
        $db_type = "mysql";	// データベースの種類


        $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

        $pd = new PDO($dsn, $db_user,$db_pass);
        $pd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pd->beginTransaction();

        $stmh = $pd -> prepare("SELECT id , pass , usename FROM userlist WHERE :usename = usename ");
        $stmh -> bindValue(':usename', $_POST["nickname"], PDO::PARAM_STR);

        $stmh -> execute();
        $pd -> commit();

        $cnt = 0;

        $usrid;
        $hashval;
        while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
            $usrid = $row['id'];
            $hashval = $row['pass'];
            $usrname = $row['usename'];
            $cnt++;
        }

        $pwd = $_POST["password"];
        if($cnt == 1){
            if(password_verify($pwd, $hashval)){
                print 'パスワードが違います';
                print '<a href="../toppage.php">トップページへ戻る</a>';
            }else {
                print 'ログインが成功しました。';
                session_start();
                $_SESSION["logined"] = true;
                $_SESSION["usrid"] = $usrid;
                $_SESSION["nickname"] = $usrname;
                print '<a href="../toppage.php">トップページへ戻る</a>';
            }
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