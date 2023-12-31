<?php
if(!class_exists('CSF')){
    // Set a unique prefix for the metabox
  $meta_prefix = 'kmf_custom_post_meta';

  // Create a metabox
  CSF::createMetabox( $meta_prefix, [
    'title'     => 'Register Post Types',
    'post_type' => 'cpr',
    'data_type' => 'unserialize',
  ] );

  // Create a section for the metabox
  CSF::createSection( $meta_prefix, [
    'fields' => [
       [
        'id' => 'post_types',
        'type' => 'group',
        'title' => 'Post Types',
        'fields' => [
          [
        'id'      => 'type',
        'type'    => 'select',
        'title'   => 'Type',
        'options' => [
          'post'  => 'Post',
          'texonomy' => 'Texonomy',
        ],
     ],
     [
      'id'=> 'post_info',
      'type' => 'fieldset',
      'title' => 'Post Info',
      'fields' => [
        [
          'id' => 'post_type_id',
          'type' => 'text',
          'title' => 'Post Type ID'
        ],
        [
          'id' => 'labels',
          'type' => 'group',
          'title' => 'Labels',
          'fields' => [
            [
              'id' => 'name',
              'type' => 'text',
              'title' => 'Name',
            ],
            [
              'id' => 'value',
              'type' => 'text',
              'title' => 'Value'
            ]
          ]
        ],
        [
        'id' => 'ispublic',
        'type' => 'switcher',
        'title' => 'Is Public'
      ],
      [
        'id' => 'show_ui',
        'type' => 'switcher',
        'title' => 'SHOW UI ?'
      ],
      [
        'id' => 'supports',
        'type' => 'checkbox',
        'title' => 'SUPPORTS',
        'options' => [
          'title' => 'Title',
          'thumbnail' => 'Thumbnail',
          'editor' => 'Editor',
          'comments' => 'Comments',
          'revisions' => 'Revisions',
          'trackbacks' => 'Trackbacks',
          'author' => 'Author',
          'excerpt' => 'Excerpt',
          'page-attributes' => 'Page-Attributes',
          'custom-fields' => 'Custom-Fields',
          'post-formats' => 'Post-Formats',
        ]
      ]
      ],
     ],
        ]
       ]
    ],
  ] );
}