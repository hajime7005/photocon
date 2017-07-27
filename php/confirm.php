<?php

require_once ('connectDBTemplate.php');
try{
    
    //GETパラメータをもと確認済みを示すconfirmの変更
       
    $st = $pd->prepare("SELECT voteid, entryid, voter, confirm FROM vote WHERE confirm = :confirm "); //SQL文
    $st->bindValue(':confirm', $_GET['id'], PDO::PARAM_INT);
    $st->execute();
    
    foreach ($st as $row){
        $vid = $row['voteid'];
        $eid = $row['entryid'];
        $vot = $row['voter'];
        $confirm = $row['confirm'];
    }

    $key = md5($vid.$eid.$vot);
    
    if($key == $_GET['key']){   //正しいリンクからやってきたか確認
    
        //正しい
        $st = $pd->prepare("UPDATE vote SET confirm = 0 WHERE voteid = $vid"); //SQL文
        $st->execute();
        $pd->commit();
        print "<p>メールアドレスが確認できたので投票を完了しました！</p>";
        print "<a href='../index.php'>トップページへ戻る</a>";
           
    }else{
        
        //不正
        print "<p>不正なアクセスです</p>";
        print "<a href='../index.php'>トップページへ戻る</a>";
        
    }


  
} catch (PDOException $Exception) {
    $pd->rollBack();
    print "エラー：" . $Exception->getMessage();
}


?>
