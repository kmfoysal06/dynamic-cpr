<?php
/**
 * helper function that should available everywhere
 *
 * @package dynamic-cpr
 * @since 2.5
 */

if (!function_exists('kmfdcpr_get_template_part')) {
    function kmfdcpr_get_template_part($slug, $name = null, $args = []) {
        // Define the template path
        $template_path = plugin_dir_path(__FILE__);
        $plugin_root_path = dirname($template_path) . '/';

        // Construct the template file name
        $template = $plugin_root_path . $slug;
        if ($name) {
            $template .= '-' . $name;
        }
        $template .= '.php';

        // Load the template file if it exists
        if (file_exists($template)) {
            load_template($template, false, $args);
        }
    }
}

/**
 * Return Template Part For Plugin
 */
if (!function_exists('kmfdcpr_return_template_part')) {
    function kmfdcpr_return_template_part($slug, $name = null, $args = []) {
        ob_start();
        charming_portfolio_get_template_part($slug, $name, $args);
        $output = ob_get_clean();
        return $output;
    }
}
