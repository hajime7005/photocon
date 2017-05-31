
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

    $pd = new PDO('mysql:host=localhost;dbname=photocon;charset=utf8', 'photocon','ju78iklo');

    $pd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmh = $pd -> prepare("SELECT id, name, usename, address, tel FROM entrant WHERE :usename = name,");
    $stmh -> bindValue(':usename', $_POST['nickname'], PDO::PARAM_STR);

    $stmh -> execute();
    $pd -> commit();

    while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $id = $row['name'];
    $id = $row['usename'];
    $id = $row['address'];



    }


    } catch(PDOException $Exception) {
    $pd -> rollBack();
    print "エラー：".$Exception -> getMessage();
    //die('接続エラー :' . $Exception->getMessage());
    }

?>

</body>
</html>