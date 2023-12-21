<?php
function cp(){register_post_type('kmf_store',['labels'=>['name' => __('KMF Store'),],'public' => true,'show_ui' => false,'supports' => [''title','description',]

		
			
		
	]);
}
if(!add_action('init','cp')){
	wp_die('some fuking error');
}