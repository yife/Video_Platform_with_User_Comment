<?php

// HTTP REST APIをつかって、コメントjsonファイルへの追記を行うphpスクリプトです。
// video_nubmer = 32, コメントしたユーザのID: 88, コメント位置: 3.5秒, コメント内容: '貴音の後ろ髪に頭を突っ込んでスンスンしたい' の場合、
// http://example.com/json_appender.php?v_num=32&id=32&vpos=35&text=%8bM%89%b9%82%cc%8c%e3%82%eb%94%af%82%c9%93%aa%82%f0%93%cb%82%c1%8d%9e%82%f1%82%c5%83X%83%93%83X%83%93%82%b5%82%bd%82%a2
//となります。

if( isset($_GET['v_num']) && isset($_GET['id']) && isset($_GET['vpos']) && isset($_GET['text']) ){
    
    
}else{
    //正常にGETリクエストが送られてこなかったら
    exit('insufficient parameters given');
}

//受け取ったリクエストをサニタイズ
$_GET['v_num'] = (int)$_GET['v_num'];
$_GET['id'] = (int)$_GET['id'];
$_GET['vpos'] = (int)$_GET['vpos'];
$_GET['text'] = htmlentities(strip_tags($_GET['text']) , ENT_QUOTES, 'UTF-8' );



//指定されたjsonファイルがあるかどうか調べる
$filepath = '/home/greenspa/htdocs/src/telop/'.$_GET['v_num'].'.json';

if( file_exists($filepath)){
    //ファイルが存在する場合
    
    if( is_writeable($filepath) && is_readable($filepath)){
        //書き込みが可能かどうか
        
    }else{
        //ファイルの読み・書きのどちらかができない
        exit("Can't read/write json file. Check permissions.");
        
    }
    
}else{
    //なければ作成
    touch($filepath);
    chmod($filepath, 0666);
    
}


//jsonファイルを連想配列として読み込み
$handle = fopen($filepath, 'r');
$comments = json_decode(fread($handle, filesize($filepath)), true);
fclose($handle);


//連想配列の末尾に、指定された内容を追記

$vpos = round( ( ($_GET['vpos']) / 10.0 ) , 2);
var_dump($vpos);

var_dump($comments);


$comments[] = array('id' => count($comments), 'user_id' => $_GET['id'], 'sec' => $vpos , 'text' => $_GET['text']);


//連想配列をjsonファイルへ再変換して保存
$handle = fopen($filepath, 'w');
fwrite($handle,json_encode($comments));
fclose($handle);

