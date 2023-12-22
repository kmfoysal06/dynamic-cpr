<?php
// Trigger action on post save
function kmf_cpr_save_or_update_post($post_id, $post, $update) {
	
    // Check if the post type is 'custom_post_type'
    if ($post->post_type === 'cpr') {
	$all_posts = get_post_meta($post_id,'post_types',true);
			$function = '';
	if (is_array($all_posts) && !empty($all_posts)) {
	$function .= "<?php
function cp(){
	" ;
	foreach($all_posts as $single_post){
		$function .= "register_post_type('".$single_post['post_info']['post_type_id']."',
	[
		'labels'=>[";
		foreach($single_post['post_info']['labels'] as $label){
			$function .= "'".$label['name']."' => __('".$label['value']."'),";
		}
		$function .= "],
		";
		$function .= $single_post['post_info']['ispublic'] == 1 ? "'public' => true,
		" : "'public' => false,
		" ;
		$function .= ($single_post['post_info']['show_ui']  == 1 || $single_post['post_info']['ispublic'] == 1) ? "'show_ui' => true,
		" : "'show_ui' => false,
		" ;
		$function .= "'supports' => [";
		foreach($single_post['post_info']['supports'] as $support){
			$function .= "'$support',";
		}
		$function .= "] 
	]);";
	}

	$function .= "	
		}
	add_action('init','cp');" ;
	}

    $pth = plugin_dir_path( __FILE__ ).'great.php';
    $file = fopen($pth, 'w');
    fwrite($file, $function);
    fclose($file);
}

}

add_action('save_post', 'kmf_cpr_save_or_update_post', 10, 3);



// [ 
// 	[0] => [ 
// 		[0] => [
// 		 [type] => post 
// 		 [post_info] => 
// 		 	[ 
// 		 		[0] => 
// 		 		[ 
// 		 			[post_type_id] => great 
// 		 			[ispublic] => 1 
// 		 			[show_ui] => ] 
// 		 	] 
// 		]
// 		  ]
// ]