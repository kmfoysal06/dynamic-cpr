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




function rgs(){
	echo 'hello';
}

add_shortcode('rgst','rgs');