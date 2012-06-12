<?php
//Smartyライブラリ
require_once('../../libs/MySmarty.class.php');
$smarty = new MySmarty();

//ログイン処理用
require_once '../../libs/classes/access.class.php';
$user = new flexibleAccess();


//ログイン判定

$error = false;

if ( !$user->login($_POST['uname'],$_POST['pwd'] )){  
    
    //ユーザIDがセットされているのにログインできなかったら、IDかパスワードを間違えたと判断
    if( isset($_POST['uname'])){
        $error = true;
        $smarty->assign('error', $error);
    }

} else {  
//ログイン後の処理  
    header('Location: index.php'); // たとえばメインページにリダイレクト  
    exit;
}  


$smarty->display('login.html');