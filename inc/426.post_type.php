<?php
function cp_426(){
	register_post_type('great',
	[
		'labels'=>[ 'name' => __('bro s'),
		],
		'public' => true,
		'show_ui' => true,
		'supports' => ['thumbnail',] 
	]);	
		}
	add_action('init','cp_426');