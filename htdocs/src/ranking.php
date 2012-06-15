<?php

//データベースへの接続を開始
$dbh = new PDO('mysql:host=localhost;dbname=nicolive', 'viewer', '8C80K53S3XTAzBDz0e');
$dbh->query("SET NAMES utf8;");

//Smartyライブラリ
require_once('../../libs/MySmarty.class.php');
$smarty = new MySmarty();

//ログイン処理用
require_once '../../libs/classes/access.class.php';
$user = new flexibleAccess();


$smarty->assign($user->userData);

if( $user->is_loaded() ){
    //ここに、ユーザがログイン済みの時の処理を書く
    
    //視聴数順にソートしてDBから全件とってくる
    $stmt = 'SELECT * FROM searchable_videos ORDER BY view_counter desc;';
    $sth = $dbh->prepare($stmt);
    $sth->execute();
    $video_data = $sth->fetchAll();
    
    $smarty->assign('video_data', $video_data);
        
    $smarty->display('ranking.html');

    
}else{
    //ここに、ユーザが未ログインのときの処理を書く
    
    $smarty->display('ranking_not_loggedin_yet.html');
    
}


//データベースへの接続を終了
$dbh = null;