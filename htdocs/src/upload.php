<?php

require_once('../../libs/MySmarty.class.php');

$smarty = new MySmarty();


$scalar = 'Hello my new smarty!';
$sex = array('m'=>'おとこ', 'f'=>'おんな');

$smarty->assign('scalar', $scalar);
$smarty->assign('sex', $sex);

$smarty->display('upload.html');