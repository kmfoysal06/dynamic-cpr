<?php
function intiti(){
    function createCustomPostType($slug,$name,$public,$showui,$supports){
        add_action('init',function() use($slug,$name,$public,$showui,$supports){
            register_post_type($slug,[
                'labels' => [
                    'name' => $name,
                ],
                'public' => $public,
                'show_ui' => $showui,
                'supports' => $supports,
                    ]);
        });
    }
    
    // createCustomPostType(get_option("kmf_cpr_data")["slug"],get_option("kmf_cpr_data")["name"],(get_option("kmf_cpr_data")["ispublic"] == 'on'),(get_option("kmf_cpr_data")["showui"] == 'on'),['title']);
    $kmf_cpr_arr = [
        [
            'slug'=>'cpr',
            'name'=>'Name CPR',
            'public'=>true,
            'showui'=>true,
            'supports'=>['title']
        ],
        [
            'slug'=>'cpr_2',
            'name'=>'Name CPR 2',
            'public'=>true,
            'showui'=>true,
            'supports'=>['title']
        ]
    ]	;
    foreach($kmf_cpr_arr as $value){
        echo var_dump($value);
        die();
    }
}
add_action( 'init', 'intiti');