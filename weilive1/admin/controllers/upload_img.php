<?php if(!defined('ROOT')) die('Access denied.');

class c_upload_img extends Admin{

	public function __construct($path){
		parent::__construct($path);

		$this->CheckAction();
	}


	public function index(){

		echo '<div style="font-size:13px;width:460px; border:1px solid #acacac;background:#ddd;margin:160px auto;padding:8px;border-radius: 6px;line-height:24px;text-shadow:1px 1px 0 #efefef;">
		<ul>
		<li>待开发</li>
		
		</ul></div>';
		
	}


} 

?>