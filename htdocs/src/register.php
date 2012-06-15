<?php

//Smartyライブラリ
require_once('../../libs/MySmarty.class.php');
$smarty = new MySmarty();

//ログイン処理用
require_once '../../libs/classes/access.class.php';
$user = new flexibleAccess();

$userID = 0;


$smarty->assign($user->userData);

//サニタイズ
$_POST['uname'] = htmlentities($_POST['uname'], ENT_QUOTES, 'UTF-8');
$_POST['pwd'] = htmlentities($_POST['pwd'], ENT_QUOTES, 'UTF-8');


$data = array(  
'username' => $_POST['uname'],  
'password' => $_POST['pwd'],  
'active' => 1  
);  

if( $_POST['uname'] and $_POST['pwd'] ){
    $userID = $user->insertUser($data);  
}elseif( $_POST['uname'] or $_POST['pwd'] ){
    $error = true;
}else{
   
}

//The method returns the userID of the new user or 0 if the user is not added  
if ($userID==0){  
    if( $_POST['uname'] and $_POST['pwd'] ){
        $successfully_registered = 'something_wrong';
    }else{
        
    }
    
}else{
    $successfully_registered = 'success'; 
}

$smarty->assign('error', $error);
$smarty->assign('successfully_registered', $successfully_registered);
$smarty->assign('userID', $userID);

$smarty->display('register.html');