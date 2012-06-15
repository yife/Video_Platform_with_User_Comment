<?php

//Smartyライブラリ
require_once('../../libs/MySmarty.class.php');
$smarty = new MySmarty();

//ログイン処理用
require_once '../../libs/classes/access.class.php';
$user = new flexibleAccess();

$smarty->assign($user->userData);

if( $user->is_loaded() ){
    //ここに、ログイン済みの処理を書く
    
    $smarty->display('upload.html');
}else{
    //ここに、未ログイン時の処理を書く
    
    //ログインをうながすページを表示
    $smarty->display('upload_not_loggedin_yet.html');
}
