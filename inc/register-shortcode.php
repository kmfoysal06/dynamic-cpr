<?php
// function viewMap($atts){
//     $maps = get_post_meta($atts['id'],'maps',true);
//     	register_post_type("cpr",[
// 		'labels' => [
// 			'name' => __('Custom Post Type'),
// 		],
// 		'public' => false,
// 		'show_ui' => true,
// 		'supports' => ['title'],
// 			]);
    
// }
// function cpr_init(){

// }
// add_action('init','cpr_init');

// Trigger action on post save
function kmf_cpr_save_or_update_post($post_id, $post, $update) {
    // Check if the post type is 'custom_post_type'
    if ($post->post_type === 'cpr') {
		add_action('init','kmf_cpr_custom_post');
		function kmf_custom_post(){
			register_post_type("great",[
		'labels' => [
			'name' => __('Great'),
		],
		'public' => true,
		'supports' => ['title'],
			]);
		}
	 add_action('init','kmf_custom_post');
	 }

}

add_action('save_post', 'kmf_cpr_save_or_update_post', 10, 3);