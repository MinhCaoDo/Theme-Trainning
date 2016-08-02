<?php 
	function cmg_plugin_activation(){
		//Khai báo plugin cần cài đặt
		$plugins = array(array('name' => 'Redux Framework'),'slug' => 'redux-framework', 'required'=>true);

		//Thiet lap TGM
		$config = array('menu' => 'tp_plugin_install',
			'has_notice' => true,
			'dismissable' => false,
			'is_automatic' => true
			);
		tgmpa( $plugins, $configs);
	}


?>