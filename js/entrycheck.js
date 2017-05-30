"use strict";


function formCheck(){
    var flag = 0;

    // 入力必須項目が入力されているかチェック
    //お名前系
    if( document . entryinfo . familykana . value == ""){
        flag = 1;
        document . getElementById( 'noticefamilykana' ) . style . display = "block"; //警告文を表示
    }else{
        document . getElementById( 'noticefamilykana' ) . style . display = "none";  //警告文を消す
    }

    if( document . entryinfo . givenkana . value == ""  ){
        flag = 1;
        document . getElementById( 'noticegivenkana' ) . style . display = "block";
    }else{
        document . getElementById( 'noticegivenkana' ) . style . display = "none";
    }

    if(document . entryinfo . familyname . value == "" ){
        flag = 1;
        document . getElementById( 'noticefamilyname' ) . style . display = "block";
    }else{
        document . getElementById( 'noticefamilyname' ) . style . display = "none";
    }

    if( document . entryinfo . givenname . value == "" ){
        flag = 1;
        document . getElementById( 'noticegivenname' ) . style . display = "block";
    }else{
        document . getElementById( 'noticegivenname' ) . style . display = "none";
    }


    //住所系
    if( document . entryinfo . postal1 . value == "" ||
        document . entryinfo . postal2 . value == ""){
        flag = 1;
        document . getElementById( 'noticepostal' ) . style . display = "block";
    }else{
        document . getElementById( 'noticepostal' ) . style . display = "none";
    }

    let postal = document.entryinfo.postal1.value + document.entryinfo.postal2.value;

    if (postal.match(/[0-9]{7}/g == null) ||
        postal.length != 7) {
        flag = 1;
        document.getElementById('wrongpostal').style.display = "block";
    } else {
        document.getElementById('wrongpostal').style.display = "none";
    }



    if( document . entryinfo . prefectures. value == "" ||
        document . entryinfo . city. value == "" ||
        document . entryinfo . address. value == "" ){
        flag = 1;
        document . getElementById( 'noticestreetaddress' ) . style . display = "block";
    }else{
        document . getElementById( 'noticestreetaddress' ) . style . display = "none";
    }


    //電話番号
    if( document . entryinfo . tel1 . value == "" ||
        document . entryinfo . tel2 . value == "" ||
        document . entryinfo . tel3 . value == "" ){
        flag = 1;
        document . getElementById( 'noticetel' ) . style . display = "block";
    }else{
        document . getElementById( 'noticetel' ) . style . display = "none";
    }

    let tel = document.entryinfo.tel1.value +
        document.entryinfo.tel2.value +
        document.entryinfo.tel3.value;
    if (tel.match(/[0-9]{9,11}/g) == null ||
        !(9 <= tel.length && tel.length <= 11)) {
        flag = 1;
        document.getElementById('wrongtel').style.display = "block";
    } else {
        document.getElementById('wrongtel').style.display = "none";
    }


    //性別
    if( document . entryinfo . gender . value == "" ||
        !(document . entryinfo . gender . value == "male" || document . entryinfo . gender . value == "female") ){
        flag = 1;
        document . getElementById( 'noticegender' ) . style . display = "block";
    }else{
        document . getElementById( 'noticegender' ) . style . display = "none";
    }

    //生年月日
    if( document . entryinfo . birthyear . value == "" ||
        document . entryinfo . birthmonth . value == "" ||
        document . entryinfo . birthday . value == "" ){
        flag = 1;
        document . getElementById( 'noticebirth' ) . style . display = "block";
    }else{
        document . getElementById( 'noticebirth' ) . style . display = "none";
    }

    //ニックネーム
    if( document . entryinfo . nickname . value == "" ){
        flag = 1;
        document . getElementById( 'noticenickname' ) . style . display = "block";
    }else{
        document . getElementById( 'noticenickname' ) . style . display = "none";
    }

    let nickname = document.entryinfo.nickname.value;
    let arynick = nickname.match(/[A-Za-z0-9]+/g);
    let pass = "";
    if (arynick != null) {
        pass = arynick[0];
    }



    //パスワード
    if( document . entryinfo . password . value == "" ||
        document . entryinfo . repassword . value == "" ){
        flag = 1;
        document . getElementById( 'noticepassword' ) . style . display = "block";
    }else{
        document . getElementById( 'noticepassword' ) . style . display = "none";
    }

    if( document . entryinfo . password . value != document . entryinfo . repassword . value ){
        flag = 1;
        document . getElementById( 'misspassword' ) . style . display = "block";
    }else{
        document . getElementById( 'misspassword' ) . style . display = "none";
    }

    if (document.entryinfo.password.value.length <= 7) {
        flag = 1;
        document.getElementById('littlepassword').style.display = "block";
    } else {
        document.getElementById('littlepassword').style.display = "none";
    }


    let ary = document.entryinfo.password.value;
    let arypas = ary.match(/[a-zA-Z0-9]{8,}/g);
    if (arypas != null) {
        let pass = arypas[0];
    }

    if (arypas == null || pass != ary) {
        flag = 1;
        document.getElementById('wrongpassword').style.display = "block";
    } else {
        document.getElementById('wrongpassword').style.display = "none";
    }









    if( flag == 1){ // 入力必須項目に未入力があった場合
        window . alert( '必須項目は全て入力して下さい。' ); // アラートを表示
        return false; // 送信中止
    }else{ // 入力必須項目が全て入力済みだった場合
        return true; // 送信実行
    }

}
// -->