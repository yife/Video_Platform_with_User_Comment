<?php

//GETリクエストで渡された検索キーワードをもとに検索するphpページ。
//「初音ミク」で検索したい場合は、
//http://example.com/src/search.php?keyword=初音ミク
//でどうぞ。

//データベースへの接続を開始
$dbh = new PDO('mysql:host=localhost;dbname=nicolive', 'viewer', '8C80K53S3XTAzBDz0e');
$dbh->query("SET NAMES utf8;");

//Smartyライブラリ
require_once('../../libs/MySmarty.class.php');
$smarty = new MySmarty();

//ログイン処理用
require_once '../../libs/classes/access.class.php';
$user = new flexibleAccess();

if( $user->is_loaded() ){
    //ここに、ユーザがログイン済みの時の処理を書く
    
/*
    //GETで検索キーワードを受け取って、空ならなにもないページを表示
    if( $_GET['keyword'] == '' ){
        $smarty->display('search_no_keyword_specified.html');
        exit;
    }
*/
    
    
    //検索キーワードをもとに全文検索
    $stmt = 'SELECT * FROM searchable_videos WHERE MATCH(video_title, video_desc, video_tags) AGAINST(:keyword);';
    $sth = $dbh->prepare($stmt);
    $sth->bindParam(':keyword', $_GET['keyword']);
    $sth->execute();
    $video_data = $sth->fetchAll();
    
    $smarty->assign('video_data', $video_data);

    $smarty->display('search.html');

    
}else{
    //ここに、ユーザが未ログインのときの処理を書く
    
    $smarty->display('search_not_loggedin_yet.html');
    
}


//データベースへの接続を終了
$dbh = null;