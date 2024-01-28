<?php
add_action( 'init', 'intiti');
function createCustomPostTypes($slug,$name,$public,$showui,$supports){
            register_post_type($slug,[
                'labels' => [
                    'name' => $name,
                ],
                'public' => $public,
                'show_ui' => $showui,
                'supports' => $supports,
                    ]);
    }
function intiti(){
    
    
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
      createCustomPostTypes($value['slug'],$value["name"],$value["public"],$value["showui"],$value['supports']);
    }
}