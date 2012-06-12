<?php
	$secret_key="6024539c45c607a0";
	$api_key="6f24aa63a2eb0cb4d7d2b2bf5fd9b2b0";
	$api_sig1=$secret_key."api_key".$api_key;
	$api_sig1=md5($api_sig1);
	//返却後の処理
	$mode=false;
	if(strlen($_GET["cert"])>0){
		$mode=true;
	}
	if($mode){
		$api_sig2=$secret_key."api_key".$api_key."cert".$_GET["cert"];
		$api_sig2=md5($api_sig2);
		var_dump($api_sig2);
		$url="http://auth.hatena.ne.jp/api/auth.json?api_key={$api_key}&cert={$_GET['cert']}&api_sig={$api_sig2}";
		$json=file_get_contents($url);
		$json=json_decode($json);
		if(strlen($json->user->name)==0)
			$mode=false;
	}
?>
<?php	if(!$mode){	?>
	<h2>はてなで認証する</h2>
	<?php
    	$auth_url = "<a href=\"http://auth.hatena.ne.jp/auth?api_key={$api_key}&api_sig={$api_sig1}\">はてなで認証する</a>";
    	print $auth_url;
	 ?>
<?php	}else{	?>
	<h2>認証成功</h2>
	<div style="border:1px solid #666;padding:5px;">
	<div style="border:1px solid #666;padding:5px;">
	はてなID:<b><?=$json->user->name?></b><br>
	<img src="<?=$json->user->image_url?>">
	</div>
<?php	}	?>