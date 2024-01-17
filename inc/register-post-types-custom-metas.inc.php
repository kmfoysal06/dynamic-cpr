<?php
if(!defined('ABSPATH')){
	exit;
	// exit if accessed directly
}
// Trigger action on post save
function kmf_dynamic_cpr_save_update_post($post_id, $post, $update) {
if($update){
	    // Check if the post type is 'custom_post_type'
    if ($post->post_type === 'cpr') {
	$post_type_info = get_post_meta($post_id,'kmf_custom_post_meta_2',true);
	$function = '';
	if (is_array($post_type_info) && !empty($post_type_info)) {
	$function .= "<?php
function kmf_dynamic_cpr_cp_".$post_id."(){
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
	add_action('init','kmf_dynamic_cpr_cp_".$post_id."');" ;
	}

    $pth = plugin_dir_path( __FILE__ ).''.$post_id.'.post_type.php';
    $file = fopen($pth, 'w');
    fwrite($file, $function);
    fclose($file);
}
}
}

add_action('save_post', 'kmf_dynamic_cpr_save_update_post', 10, 3);
// Hook to the post_updated_messages filter
add_filter('post_updated_messages', 'kmf_dynamic_cpr_updated_message');

function kmf_dynamic_cpr_updated_message($messages) {
    global $post, $post_ID;

    // Check if the post type is 'cpr'
    if ('cpr' === get_post_type($post_ID)) {
        $messages['cpr'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __("Saved! If you can't see the changes on your custom post type, please try updating this post again.", 'textdomain'),
        );
    }

    return $messages;
}
