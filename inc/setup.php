<?php
/**
 * Setup Options and Everything Needed
 *
 * @package dynamic-cpr
 * @since 2.5
*/

if(!defined('ABSPATH')){
    exit;
}

// create option page for cpr and submenu for settings
function cpr_options_page(){
    add_menu_page('Dynamic CPR', 'Dynamic CPR', 'manage_options', 'dynamic-cpr', 'cpr_options_page_html', 'dashicons-welcome-add-page');
    add_submenu_page('dynamic-cpr', 'Settings', 'Settings', 'manage_options', 'dynamic-cpr-settings', 'cpr_settings_page_html');
}

// create option page html
function cpr_options_page_html(){
   kmfdcpr_get_template_part('templates/overview'); 
}

// create settings page html
function cpr_settings_page_html(){
   kmfdcpr_get_template_part('templates/settings'); 
}

// add action to create option page
add_action('admin_menu', 'cpr_options_page');

