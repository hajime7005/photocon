<?php
session_start();
?>
<HTML>
<HEAD>
    <TITLE>PHPのテスト</TITLE>
</HEAD>
<BODY>
<?php

$time = date('ymdHis' ,$timestamp = time());

$resizeX   = 150;
//$thumbnail_name = "t_" . $_FILES["uploadfile"]["name"] ;
$thumbnail_name = "t_" . $_SESSION["nickname"] ."_" . $time . ".jpg" ;

$file_dir_pro  = $_SERVER["DOCUMENT_ROOT"].'/photocon/image/';// Windows
$file_dir = str_replace('html/','',$file_dir_pro);

//$file_dir  = '/Applications/XAMPP/xamppfiles/htdocs/image/'; // Mac
//$file_dir  = '/opt/lampp/htdocs/image/';// Linux

$photoname = $_SESSION["nickname"] ."_" . $time . ".jpg";
$file_path = $file_dir  . $photoname;
$thumbnail_file_path = $file_dir . $thumbnail_name ;

print $file_path;

if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $file_path)) {

    $img_dir   = "../image/";
    $img_path  = $img_dir. $photoname;
    $thumbnail_img_path = $img_dir . $thumbnail_name ;

    print mb_strpos($_FILES['uploadfile']['type'], 'jpeg');
    if ( mb_strpos($_FILES['uploadfile']['type'], 'jpeg') ) {
        $gdimg_in = imagecreatefromjpeg($file_path);
        $ix = imagesx($gdimg_in); $iy = imagesy($gdimg_in);
        $ox = $resizeX;
        $oy = ($ox * $iy) / $ix;
        $gdimg_out = imagecreatetruecolor($ox, $oy);
        imagecopyresized($gdimg_out, $gdimg_in, 0, 0, 0, 0, $ox, $oy, $ix, $iy);
        imagejpeg($gdimg_out, $thumbnail_file_path);
        imagedestroy($gdimg_in);
        imagedestroy($gdimg_out);
        $size      = getimagesize($file_path);
        $size2     = getimagesize($thumbnail_file_path);
        ?>

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
            print "接続しました... <br>";
        } catch(PDOException $Exception) {
            die('エラー :' . $Exception->getMessage());
        }

        try {
            $pdo->beginTransaction();

            $sql = "INSERT  INTO contributions (filename, usename, title, comment) VALUES ( :filename, :usename, :title, :comment)";
            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':filename',  $photoname,  PDO::PARAM_STR );
            $stmh->bindValue(':usename',  $_SESSION['nickname'],  PDO::PARAM_STR );
            $stmh->bindValue(':title',  $_POST['title'],  PDO::PARAM_STR );
            $stmh->bindValue(':comment',  $_POST['comment'],  PDO::PARAM_STR );

            $stmh->execute();
            $pdo->commit();
            ?>

            ファイルアップロードを完了しました。<BR>
            <IMG src="<?=$img_path?>" <?=$size[3]?>>
            <IMG src="<?=$thumbnail_img_path?>" <?=$size2[3]?>>
            <BR>
            <B><?=$_POST["comment"]?></B><BR>
            <a href="../index.php">トップページに戻る</a>

            <?php
        } catch (PDOException $Exception) {
            $pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
        ?>

        <?php
    } else {
        print "JPEG形式の画像をアップロードしてください。<BR>";
        print "<a href=\"../toppage.php\">トップページに戻る</a>";
    }
} else {
    print "正常にアップロード処理されませんでした。<BR>";
    print "<a href=\"../toppage.php\">トップページに戻る</a>";
}
?>
</BODY>
</HTML>