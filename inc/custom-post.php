<?php 
add_action('init','kmf_cpr_custom_post');
function kmf_cpr_custom_post(){
	register_post_type("cpr",[
'labels' => [
	'name' => __('CPR'),
],
'public' => false,
'show_ui' => true,
'capability_type' => 'post',
'capabilities' => [ 'create_posts' => false, ],
'map_meta_cap' => true,
'menu_icon' => 'dashicons-welcome-add-page',
'supports' => ['title'],
	]);
}