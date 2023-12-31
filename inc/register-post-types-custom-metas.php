<?php
// Trigger action on post save
function kmf_cpr_save_or_update_post($post_id, $post, $update) {
	
    // Check if the post type is 'custom_post_type'
    if ($post->post_type === 'cpr') {
	$post_type_info = get_post_meta($post_id,'kmf_custom_post_meta_2',true);
	$function = '';
	if (is_array($post_type_info) && !empty($post_type_info)) {
	$function .= "<?php
function cp(){
	" ;
		$function .= "register_post_type('".$post_type_info['cpr_id']."',
	[
		'labels'=>[ 'name' => __('".$post_type_info['cpr_name']."'),
		],
		";
		$function .= $post_type_info['ip'] == 'on' ? "'public' => true,
		" : "'public' => false,
		" ;
		$function .= ($post_type_info['su']  == 'on' || $post_type_info['ip'] == 'on' ) ? "'show_ui' => true,
		" : "'show_ui' => false,
		" ;
		$function .= "'supports' => [";
		foreach($post_type_info['supports'] as $support){
			$function .= "'$support',";
		}
		$function .= "] 
	]);";

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