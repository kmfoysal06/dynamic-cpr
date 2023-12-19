<?php
if(class_exists('CSF')){
    // Set a unique prefix for the metabox
  $meta_prefix = 'kmf_custom_post_meta';

  // Create a metabox
  CSF::createMetabox( $meta_prefix, [
    'title'     => 'Options',
    'post_type' => 'cpr',
    'data_type' => 'unserialize',
  ] );

  // Create a section for the metabox
  CSF::createSection( $meta_prefix, [
    'fields' => [
      [
        'id'      => 'post_type',
        'type'    => 'select',
        'title'   => 'Post Type',
        'options' => [
          'post'  => 'Post',
          'texonomy' => 'Texonomy',
        ],
     ],
     [
      'id'=> 'maps',
      'type' => 'group',
      'title' => 'Maps',
      'fields' => [
        [
          'id' => 'maptitle',
          'type' => 'text',
          'title' => 'Title'
        ],
        [
          'id' => 'latitude',
          'type' => 'text',
          'title' => 'Latitude'
        ],
        [
          'id' => 'longitude',
          'type' => 'text',
          'title' => 'Longitude'
        ],
        [
          'id' => 'address',
          'type' => 'text',
          'title' => 'Address'
        ],
        [
          'id' => 'phone',
          'type' => 'text',
          'title' => 'Phone'
        ],
        [
          'id' => 'hours',
          'type' => 'text',
          'title' => 'Hours'
        ],
        [
          'id' => 'website',
          'type' => 'text',
          'title' => 'Website'
        ],
      ],
     ],
    ],
  ] );
}