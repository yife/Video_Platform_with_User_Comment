<?php

// HTTP REST APIをつかって、タグの追記を行うphpスクリプトです。
// ネルドラム を追記したい場合、
// http://example.com/tag_appender.php?v_num=32&id=32&tag=ネルドラム
//となります。

//データベースへの接続を開始
$dbh = new PDO('mysql:host=localhost;dbname=nicolive', 'tag_appender', 'EraZIa5igYRUC7Z8lD');
$dbh->query("SET NAMES utf8;");


if( isset($_GET['v_num']) && isset($_GET['tag']) ){
    
    
}else{
    //正常にGETリクエストが送られてこなかったら
    exit('insufficient parameters given');
}

//受け取った動画IDのタグ一覧を受け取る
$stmt = "SELECT video_tags FROM searchable_videos WHERE video_number = :video_number";
$sth = $dbh->prepare($stmt);
$sth->bindParam(':video_number', $_GET['v_num']);
$sth->execute();
$video_data = $sth->fetch(PDO::FETCH_ASSOC);

//DBに存在しない動画ならエラーを吐いて終了
if ( $video_data == false){
    exit('wrong v_num: the video which you specified is not exist.');
}

$video_tags = $video_data['video_tags'];

//タグ一覧の末尾に、スペース区切りで新しいタグを追加
$video_tags = $video_tags . ' ' . $_GET['tag'];

//新しいタグ一覧をDBに格納
$stmt = "UPDATE searchable_videos SET video_tags = :video_tags WHERE video_number = :video_number";
$sth = $dbh->prepare($stmt);
$sth->bindParam(':video_number', $_GET['v_num']);
$sth->bindParam(':video_tags', $video_tags);
$sth->execute();