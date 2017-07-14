<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
</head>
<body>
    <p>ようこそ！<?php print $_SESSION['nickname'] ?> さん</p>
    <a href="../smartPHP/smartMypage.php">写真を投稿する。</a><BR>
    <a href="../index.php">トップページへ戻る</a><br>

</body>
</html>