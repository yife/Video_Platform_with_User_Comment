<?php
//基本ディレクトリを定数で定義
define('ROOT_DIR', '/home/greenspa');

//Smartyクラスを読み込む
require(ROOT_DIR.'/libs/Smarty.class.php');


class MySmarty extends Smarty {
	function MySmarty() {
		$this->template_dir		= ROOT_DIR.'/templates';
		$this->compile_dir		= ROOT_DIR.'/templates_c';
		$this->left_delimiter = '{{';
		$this->right_delimiter = '}}';
		$this->plugins_dir = array('plugins', 'myplugins');
		$this->Smarty();

	}
}