<?php
function cp(){
	register_post_type('kmf_dokan',
	[
		'labels'=>['name' => __('KMF NEW'),],
		'public' => true,
		'show_ui' => true,
		'supports' => ['title','thumbnail','editor','comments',] 
	]);
		
	}
	add_action('init','cp');
	