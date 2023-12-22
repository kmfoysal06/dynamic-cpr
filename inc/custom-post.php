<?php 
add_action('init','kmf_cpr_custom_post');
function kmf_cpr_custom_post(){
	register_post_type("cpr",[
'labels' => [
	'name' => __('CPR'),
],
'public' => false,
'show_ui' => true,
'menu_icon' => 'dashicons-welcome-add-page',
'supports' => ['title'],
	]);
}