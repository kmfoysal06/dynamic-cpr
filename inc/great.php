<?php
function cp(){
	register_post_type('kmf store',
	[
		'labels'=>['name' => __('Post type 1'),],
		'public' => true,
		'show_ui' => true,
		'supports' => ['title',] 
	]);	
		}
	add_action('init','cp');