<?php
// add_action('before_delete_post','delete_registered_cpr');

// function delete_registered_cpr($post_id){
// 		if(file_exists(plugin_dir_path(__FILE__)."inc/".$post_id.".great.php")){
// 			if(!unlink(plugin_dir_path(__FILE__)."inc/".$post_id.".great.php")){
// 				echo 'funcked';
// 			}else{
// 				echo 'great';
// 			}
// 		}
// 		echo  var_dump(file_exists(str_replace('/', "\\", plugin_dir_path(__FILE__)) . $post_id . '.great.php'));
// ;
// ;
// 		die();
// }