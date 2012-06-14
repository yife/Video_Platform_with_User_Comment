#!/usr/bin/php
<?php


//二重起動を防ぐ処理
//鍵ファイルを用いてロックかける
//処理開始直後に鍵ファイル　calcrawler_1_key　を生成し、処理終了後に鍵ファイルを削除する
//処理開始前に鍵ファイルが存在する場合は処理しない

$key_name = './crawler_key';
if (!file_exists($key_name)) {
    touch($key_name);       //鍵ファイルを生成
    chmod( $key_name, 777); //鍵ファイルのパーミッションを全部許可
    echo '!!!![Calcrawler 1]' .PHP_EOL.'Key GENERATED !!!!'.PHP_EOL;
    
//    include './timeshift_crawler.php';
    include './crawler.php';
    
    unlink($key_name);
    echo '[Calcrawler 1] key removed'.PHP_EOL;
}
else{   
    echo '[Calcrawler 1] key already ganarated'.PHP_EOL;
}