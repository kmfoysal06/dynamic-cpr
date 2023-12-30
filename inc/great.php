<?php
function cp(){
	register_post_type('kmf_1',
	[
		'labels'=>[],
		'public' => true,
		'show_ui' => true,
		'supports' => ['title',] 
	]);	
		}
	add_action('init','cp');