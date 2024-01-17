<?php
function kmf_dynamic_cpr_cp_456(){
	register_post_type('great',
	[
		'labels'=>[ 'name' => __('name'),
		],
		'public' => true,
		'show_ui' => true,
		'supports' => ['thumbnail',] 
	]);	
		}
	add_action('init','kmf_dynamic_cpr_cp_456');