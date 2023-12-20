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





function save_p($postId){
	global $post;
	if($post->post_type != 'cpr'){
	function rgs(){
		echo 'not cpr';
	}
	}
	function rgs(){
	    echo 'cpr';
	}
}

add_action('save_post','save_p',338);
add_shortcode('rgs','rgs');