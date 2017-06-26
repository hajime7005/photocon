<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>エントリー情報確認ページ：笑顔の写真コンテスト(仮)</title>
</head>
<body>

<h1>入力情報確認画面</h1>

<FORM name="gosql" method="post" action="entrycompreat.php" >
    <?php
    //$familykana = htmlspecialchars($_POST["familykana"]);
    //$givenkana = htmlspecialchars($_POST["givenkana"]);
    $familyname = htmlspecialchars($_POST["familyname"]);
    $givenname = htmlspecialchars($_POST["givenname"]);

    print "お名前<br>";
    //print "セイ：${familykana}　メイ：${givenkana}<br>";
    print "姓　：${familyname}　名　：${givenname}";
    print  "<br><br>";
    ?>

    <?php
    $postal1 = htmlspecialchars($_POST["postal1"]);
    $postal2 = htmlspecialchars($_POST["postal2"]);
    $prefectures = htmlspecialchars($_POST["prefectures"]);
    $city = htmlspecialchars($_POST["city"]);
    $address = htmlspecialchars($_POST["address"]);

    print "住所<br>";
    print "〒　${postal1}-${postal2}<br>";
    print "${prefectures}　${city}　${address}";
    print "<br><br>";
    ?>

    <?php
    $tel1 = htmlspecialchars($_POST["tel1"]);
    $tel2 = htmlspecialchars($_POST["tel2"]);
    $tel3 = htmlspecialchars($_POST["tel3"]);

    print "電話番号：";
    print "${tel1}-${tel2}-${tel3}";
    print "<br><br>"
    ?>

    <?php
    $gender = htmlspecialchars($_POST["gender"]);

    print "性別：";
    print "${gender}";
    print "<br><br>"
    ?>

    <?php
    $birthyear = htmlspecialchars($_POST["birthyear"]);
    $birthmonth = htmlspecialchars($_POST["birthmonth"]);
    $birthday = htmlspecialchars($_POST["birthday"]);

    print "生年月日<br>";
    print "${birthyear}年　${birthmonth}月　${birthday}日";
    print "<br><br>"
    ?>

    <?php
    $nickname = htmlspecialchars($_POST["nickname"]);
        print "希望するユーザー名<br>";
        print $nickname;
        print "<br><br>"
    ?>

    <?php
    $password = htmlspecialchars($_POST["password"]);
    $astpass = str_repeat('*', strlen($password));
        print "パスワード(保護のため伏字で表示します)<br>";
        print "$astpass";
        print "<br><br>"
    ?>


    <input type="button" value="修正する" onClick="location.href='entry.html'">
    <input type="submit" value="登録する">
    <br>

    <?php
    //名前
    print "<INPUT type=\"hidden\" name=\"name\" value= \"${familyname}.${givenname}\" >";
    //ニックネーム
    print "<INPUT type=\"hidden\" name=\"nickname\" value = \"${nickname}\" >";
    //住所
    print "<INPUT type=\"hidden\" name=\"address\" value = \"${prefectures}.${city}.${address}\" >";
    //電話番号
    print "<INPUT type=\"hidden\" name=\"telnum\" value = \"${tel1}.${tel2}.${tel3}\" >";
    //パスワード
    print "<INPUT type=\"hidden\" name=\"passwd\" value = \"${password}\" >";
    //性別
    print "<INPUT type=\"hidden\" name=\"gender\" value = \"${gender}\" >";
    //生年月日
    print "<INPUT type=\"hidden\" name=\"birth\" value = \"${birthyear}./.${birthmonth}./.${birthday}\" >";


    ?>



</FORM>
</body>
</html>