



<?php

require_once './php/connectDBTemplate.php';

try {

    $sql = "SELECT id, title, filename, usename, comment, uploaddate FROM  contributions ";
    $stmh = $pdo->prepare($sql);

    //ステートメントを実行する
    $stmh->execute();
    //コミット
    $pd->commit();

?>
<div class="container-fluid">
    <div class="row row-eq-height" style="display: flex; flex-wrap:  wrap">
        <?php

    $path = 'http://'.$_SERVER["SERVER_NAME"].'/photocon/image/';
    while($row = $stmh -> fetch(PDO::FETCH_ASSOC)) {
        $file = $row['filename'];
        $filename = 't_'.$row['filename'];
        $title = $row['title'];
        $comment = $row['comment'];
        $user = $row['usename'];
        print '<div class="col-xs-6 col-md-3">';
        print '<a href="'.$path.'../php/photodetail.php?photo='.$file.'&title='.$title.'&comment='.$comment.'&user='.$user
                . '" class="thumbnail" target="_blank">'
                . '<img src="'.$path.$filename.'" width="90%"></a><br>';

        print '</div>';
    }
        ?>
    </div>
</div>
<?php
} catch (PDOException $Exception) {
    $pdo->rollBack();
    print "エラー：" . $Exception->getMessage();
}
?>

