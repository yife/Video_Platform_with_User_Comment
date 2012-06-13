<?php

//ログイン処理用
require_once '../../libs/classes/access.class.php';
$user = new flexibleAccess();


$user->logout('http://yife.info/src/login.php');  