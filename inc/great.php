<?php
function cp(){
	register_post_type('name',
	[
		'labels'=>['name' => __('Great IFF'),],
		'public' => true,
		'show_ui' => true,
		'supports' => [] 
	]);	
		}
	add_action('init','cp');