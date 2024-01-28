<?php
if(!defined('ABSPATH')){
	exit;
	// exit if accessed directly
}
function createCustomPostTypes($slug,$name,$public,$showui,$supports){
            register_post_type($slug,[
                'labels' => [
                    'name' => $name,
                ],
                'public' => $public,
                'show_ui' => $showui,
                'supports' => $supports,
                    ]);
    }
add_action('init', "kmf_cpr_register_post_types");
function kmf_cpr_register_post_types(){
	$query = new WP_Query(['post_type'=>'cpr','posts_per_page'=>'-1']);
	while($query->have_posts()){
		$query->the_post();
		$post_type_info = get_post_meta(get_the_ID(),'kmf_custom_post_meta_2',true);
		if(!empty($post_type_info)){
			if(isset($post_type_info['ip'])){
				if(($post_type_info['ip'] == 'on')){
					$public = true;
				}else{
					$public = false;
				}
			}else{
				$public = false;
			}
			if(isset($post_type_info['su'])){
				if(($post_type_info['su']  == 'on' || $post_type_info['ip'] == 'on' )){
					$showui = true;
				}else{
					$showui = false;
				}
			}else{
				$showui = false;
			}
			
			createCustomPostTypes($post_type_info['cpr_id'],$post_type_info['cpr_name'],$public, $showui,$post_type_info['supports']);
		}
	}
	}
// Hook to the post_updated_messages filter
add_filter('post_updated_messages', 'kmf_dynamic_cpr_updated_message');

function kmf_dynamic_cpr_updated_message($messages) {
    global $post, $post_ID;

    // Check if the post type is 'cpr'
    if ('cpr' === get_post_type($post_ID)) {
        $messages['cpr'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __("Saved!", 'textdomain'),
        );
    }

    return $messages;
}
