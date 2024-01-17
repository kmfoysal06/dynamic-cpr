<?php

if(!defined('ABSPATH')){
	exit;
	// exit if accessed directly
}


add_action('before_delete_post','kmf_dynamic_cpr_delete_registered_cpr');

function kmf_dynamic_cpr_delete_registered_cpr($post_id){
		if(file_exists(str_replace('/', "\\", plugin_dir_path(__FILE__)) . $post_id . '.post_type.php')){
			unlink(str_replace('/', "\\", plugin_dir_path(__FILE__)) . $post_id . '.post_type.php') ;
		}
}