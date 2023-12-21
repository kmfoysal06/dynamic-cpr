<?php
function cp(){register_post_type('kmf_store',['labels'=>['name' => __('KMF STORE'),],'public' => true,'show_ui' => true,'supports' => ['title','editor',]	
	]);
}
add_action('init','cp');
