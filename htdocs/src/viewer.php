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

//GETリクエストをサニタイズ
$_GET['video_number'] = htmlspecialchars($_GET['video_number'], ENT_QUOTES);


if( $user->is_loaded() ){
    //ここに、ユーザがログイン済みの時の処理を書く
    
    if(isset( $_GET['video_number'])){
        //指定された動画へのパスを生成
        $video_path = 'http://yife.info/src/converted/'.$_GET['video_number'].'.mp4';
        
        //指定された動画の視聴回数を1増やす
        $sth = $dbh->prepare("UPDATE searchable_videos SET view_counter = view_counter + 1 WHERE video_number = :video_number");
        $sth->bindParam(':video_number', $_GET['video_number']);
        $sth->execute();
        
        //指定された動画のタイトル・動画説明文を取得
        $sth = $dbh->prepare("SELECT * FROM `searchable_videos` WHERE video_number = :video_number");
        $sth->bindParam(':video_number', $_GET['video_number']);
        $sth->execute();
        $video_data = $sth->fetch(PDO::FETCH_ASSOC);
                
        $smarty->assign('video_path', $video_path);
        $smarty->assign($video_data);
        $smarty->assign($user->userData);
        $smarty->assign('video_number', $_GET['video_number']);
        
        $smarty->display('viewer.html');
    }
    

    
}else{
    //ここに、ユーザが未ログインのときの処理を書く
    
    
    $smarty->display('viewer_not_loggedin_yet.html');
    
}


//データベースへの接続を終了
$dbh = null;