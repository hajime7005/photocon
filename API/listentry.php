


<?php
class listentry{

    public $allPhoto;   //DB内のフォトデータすべてをJSONで

    public function __construct()
    {
        $db_user = "photocon";    // ユーザー名
        $db_pass = "ju78iklo";    // パスワード
        $db_host = "localhost";    // ホスト名
        $db_name = "photocon";    // データベース名
        $db_type = "mysql";    // データベースの種類


        $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";

        try {
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch
        (PDOException $Exception) {
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


            $array = array();
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $title = $row['title'];
                $filename = $row['filename'];
                $thumbname = 't_' . $row['filename'];
                $username = $row['usename'];
                $comment = $row['comment'];
                $upload = $row['uploaddate'];

                $photodata = array(
                    'id' => $id,
                    'title' => $title,
                    'filename' => $filename,
                    'thumb' => $thumbname,
                    'user' => $username,
                    'comment' => $comment,
                    'uploaded' => $upload
                );

                array_push($array, $photodata);
            }

            $enc = json_encode($array, JSON_PRETTY_PRINT);

            $this->allPhoto = $enc;

            /*
            //デコード
            $json = mb_convert_encoding($enc, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
            $dec = json_decode($json, true);
            var_dump($dec);
            $test = $dec[0]['thumb'];
            print "<img src='../image/". $test ."'>";
            */

        } catch (PDOException $Exception) {
            $pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    public function showJson(){
        echo $this->allPhoto;
    }

}

?>
