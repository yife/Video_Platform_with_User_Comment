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

    
//トップページだけは未ログインでも見られるようにする

//新着順にソートしてDBから全件とってくる
$stmt = 'SELECT * FROM searchable_videos ORDER BY video_number desc limit 10;';
$sth = $dbh->prepare($stmt);
$sth->execute();
$video_data = $sth->fetchAll();

$smarty->assign('video_data', $video_data);
    
$smarty->display('index.html');



//データベースへの接続を終了
$dbh = null;