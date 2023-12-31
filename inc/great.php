<?php
function cp(){
	register_post_type('cpr_gt',
	[
		'labels'=>[ 'name' => __('Great Post'),
		],
		'public' => false,
		'show_ui' => true,
		'supports' => ['title','thumbnail','editor',] 
	]);	
		}
	add_action('init','cp');