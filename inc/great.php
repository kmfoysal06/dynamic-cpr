
<?php
function cp(){
	register_post_type('great',[
		'labels'=>[
			'name' => __('Great'),
		],
		'public' => true,
		'supports' => ['title'],
	]);
}
if(!add_action('init','cp')){
	wp_die('some fuking error');
}