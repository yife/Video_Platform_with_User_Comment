<?php
//Smartyライブラリ
require_once('../../libs/MySmarty.class.php');
$smarty = new MySmarty();

//ログイン処理用
require_once '../../libs/classes/access.class.php';
$user = new flexibleAccess();

$smarty->assign($user->userData);

//すでにログイン済みかどうかチェック
if( $user->is_loaded() ){
    //ここに、ログイン済みの処理を書く
    $smarty->assign('username', $user->userData['username']);
    
    $smarty->display('login_already_logged_in.html');
    
}else{
    //ここに、未ログイン時の処理を書く
        
    //ログインボックスの判定
    $error = false;
    
    if ( !$user->login($_POST['uname'],$_POST['pwd'] )){  
    
        //サニタイズ
        $_POST['uname'] = htmlentities($_POST['uname'],  ENT_QUOTES , 'UTF-8');
        $_POST['pwd'] = htmlentities($_POST['pwd'],  ENT_QUOTES , 'UTF-8');
        
        //ユーザIDがセットされているのにログインできなかったら、IDかパスワードを間違えたと判断
        if( $_POST['uname'] ){
            $error = true;
            $smarty->assign('error', $error);
        }
    
    } else {  
    //ログイン後の処理  
        header('Location: index.php'); // たとえばメインページにリダイレクト  
        exit;
    }  
    
    
    $smarty->display('login_not_logged_in_yet.html');
    
}


