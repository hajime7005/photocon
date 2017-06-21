
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>singleentry.php</title>
</head>
<body>

<form action="singleentry.php" method="get">

    <p>作品のID：　<input type="text" name="id"></p>

    <input type="submit" name="submit" value="検索">
</form>
<br>
<?php

if(isset($_GET['id'])) {
    require_once('listentry.php');
    $listentry = new listentry();
    $all = json_decode($listentry->allPhoto, true);

    $id = $_GET['id'];

    $result;
    foreach($all as $onephoto) {
        if ($onephoto['id'] == $id ) {
            $result = array();
            $result = $onephoto;
        }
    }

    if(isset($result)){
        $thePhoto = json_encode($result, JSON_PRETTY_PRINT);
        print $thePhoto;

        /*
        //写真も表示する
        $decoded = json_decode($thePhoto, true);
        $photo = $decoded['filename'];
        print "<img src='http://localhost/qhotocon/photocon/image/${photo}'>";  //xammpバージョン
        */

    }else{
        print "<br>該当する写真がありませんでした。<br>";
    }


}

?>


</body>
</html>
