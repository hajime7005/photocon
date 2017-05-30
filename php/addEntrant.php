<html>
<head><title>PHP TEST</title></head>
<body>
<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=photocon;charset=utf8', 'photocon','ju78iklo');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $pdo -> prepare("INSERT INTO entrant (name, usename, address, tel) VALUES (:name , :usename , :address , :tel )");

    $stmt -> bindValue(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt -> bindValue(':usename', $_POST['nickname'], PDO::PARAM_STR);
    $stmt -> bindValue(':address', $_POST['address'], PDO::PARAM_STR);
    $stmt -> bindValue('tel', $_POST['telnum'], PDO::PARAM_STR);

    $stmt -> execute();
    $pdo -> commit();



} catch(PDOException $Exception) {
    $pdo -> rollBack();
    print "エラー：".$Exception -> getMessage();
   //die('接続エラー :' . $Exception->getMessage());
}


try {

    $pd = new PDO('mysql:host=localhost;dbname=photocon;charset=utf8', 'photocon','ju78iklo');

    $pd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmh = $pd -> prepare("SELECT id, name, usename, address, tel FROM entrant WHERE :usename = name");
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

