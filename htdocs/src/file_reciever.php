<?php

//Smartyライブラリ
require_once('../../libs/MySmarty.class.php');
$smarty = new MySmarty();

//ログイン処理用
require_once '../../libs/classes/access.class.php';
$user = new flexibleAccess();

//データベースへの接続を開始
$dbh = new PDO('mysql:host=localhost;dbname=nicolive', 'file_reciever', 'W2Y7yPTxw5xt9pbWBb');
$dbh->query("SET NAMES utf8;");


//アップロードされたファイルを、変換前動画保存場所へ移動する
if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) {



    //nicolive.upload_videos_not_converted_yetテーブルへ、動画情報を登録
    $video_title = htmlspecialchars($_POST['video_title'], ENT_QUOTES);
    $video_desc = htmlspecialchars($_POST['video_desc'], ENT_QUOTES);
    $upnushi_id = $user->userID;
    $stmt = "INSERT INTO upload_videos_not_converted_yet( video_title, video_desc, upnushi_id) values( :video_title, :video_desc, :upnushi_id)";
    $sth = $dbh->prepare($stmt);
    $sth->bindParam(':video_title', $video_title);
    $sth->bindParam(':video_desc', $video_desc);
    $sth->bindParam(':upnushi_id', $upnushi_id);
    $sth->execute();
    
    $last_inserted_id = $dbh->lastInsertId();
    
    //nicolive.encoding_queueテーブルへ、動画情報を登録
    $stmt = "INSERT INTO encoding_queue( video_number) values( :video_number)";
    $sth = $dbh->prepare($stmt);
    $sth->bindParam(':video_number', $last_inserted_id);
    $sth->execute();

    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], "./not_converted_yet/" . $last_inserted_id )) {
        chmod("not_converted_yet/" . ($last_inserted_id) , 0644);
        echo ($last_inserted_id ) . "をアップロードしました。";
    } else {
        echo "ファイルをアップロードできませんでした。。。";
      }
} else {
    echo "ファイルが選択されていません。";
}




//データベースへの接続を終了
$dbh = null;