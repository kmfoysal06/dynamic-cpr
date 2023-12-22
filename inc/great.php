<?php
function cp(){register_post_type('kmf_store',
	[
	'labels'=>	['name' => __('KMF STORE'),],
	'public' => false,
	'show_ui' => false,
	'supports' => ['title','editor',]	
	]);
}
add_action('init','cp');
