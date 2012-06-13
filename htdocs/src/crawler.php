<?php

//データベースへの接続を開始
$dbh = new PDO('mysql:host=localhost;dbname=nicolive', 'crawler', '8OQa8Ucw9UhHeAKysb');
$dbh->query("SET NAMES utf8;");

//encoding_queueから1行だけ取ってくる
$sth = $dbh->prepare("SELECT video_number FROM `encoding_queue` LIMIT 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);    // $result → Array ( [video_number] => 20 )

$last_modified_id = $result['video_number'];

//処理待ちの動画を取得できたら変換処理開始
if( isset($result['video_number'])){
    
    //元動画のファイルパス
    $source_video_path = '/home/greenspa/htdocs/src/not_converted_yet/'.$result['video_number'];
    
    //変換したあとのファイルパス
    $output_video_path = '/home/greenspa/htdocs/src/converted/'.$result['video_number'].'.mp4';
    
    //ffmpegで動画を変換する
    $command_string = "ffmpeg -y -i {$source_video_path} -vpre libx264-default -vcodec libx264 -r 60 -b 600k -s 648x486 -deinterlace -acodec libfaac -ar 44100 -ab 128k {$output_video_path}";
    exec($command_string, $output);
    
    //いまエンコードした動画の情報をデータベースから取ってくる
    $sth = $dbh->prepare("SELECT * FROM `upload_videos_not_converted_yet` WHERE auto_id = :auto_id");
    $sth->bindParam(':auto_id', $result['video_number']);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    
    //取ってきた動画の情報をsearchable_videosに追加
    $sth = $dbh->prepare("INSERT INTO searchable_videos( video_number, video_title, video_desc, upnushi_id) values( :video_number, :video_title, :video_desc, :upnushi_id)");
    $sth->bindParam(':video_number', $result['auto_id']);
    $sth->bindParam(':video_title', $result['video_title']);
    $sth->bindParam(':video_desc', $result['video_desc']);
    $sth->bindParam(':upnushi_id', $result['upnushi_id']);
    $sth->execute();
    
    //いまエンコードした動画の情報を、キューから削除
    $sth = $dbh->prepare("DELETE FROM encoding_queue WHERE video_number = :video_number");
    $sth->bindParam(':video_number', $last_modified_id);
    $sth->execute();
    
    //いまエンコードした動画の情報を、未エンコードテーブルから削除
    $sth = $dbh->prepare("DELETE FROM upload_videos_not_converted_yet WHERE auto_id = :video_number");
    $sth->bindParam(':video_number', $last_modified_id);
    $sth->execute();
    
    
}else{
    //すでにすべての動画の処理が完了していたら
    
    //とくになにもしない！
    
}