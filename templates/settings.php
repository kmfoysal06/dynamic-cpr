<?php
/**
 * Settings Page to Customize and Manage Custom Post Types
 *
 * @package dynamic-cpr
 * @since 2.5
 */

if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly.
}
$post_type_id = 'a';
$post_type_title = 'Books';

?>

<div class="kmfdcpr-admin-container kmfdcpr-settings">
<h1>Dynamic CPR Settings Page</h1>

    <div class="post-types-container">
        <div class="single-post-type">
            <h2><?php echo esc_html($post_type_title); ?></h2>
            <div class="fields-container">

               <?php wp_nonce_field(basename(__FILE__), 'kmfdcpr_meta_nonce'); ?>

            <p><b>post type id and name must be unique and only contain alphanumeric characters and underscores and length should be less than 20</b></p>
            <div class="kmfdcpr-field pt">
              <label class="col-25" for="pt">Post Type ID</label>
              <input type="text" id="pt" name="kmfcpr_metadata[cpr_id]" value=""  required>
            </div>

            <div class="kmfdcpr-field name">
              <label class="col-25" for="name">Post Type Name</label>
              <input type="text" id="name" name="kmfcpr_metadata[cpr_name]" value="" required >
            </div>


            <div class="kmfdcpr-field ip">
                <input type="checkbox" id="ip" name="kmfcpr_metadata[ip]" >
                <label for="ip">is Public</label>
            </div>
    
            <div class="kmfdcpr-field su">
                <input type="checkbox" id="su" name="kmfcpr_metadata[su]" >
                <label for="su">Show UI</label>
            </div>
    
            <div class="kmfdcpr-field sup">
                <p><span title="If you don't select anything, the default supports (title and editor) will be added.">Supports</span></p>
                <div class="inputs">
                <input type="checkbox" id="meta-title" name="kmfcpr_metadata[supports][]" value="title" >
                <label for="meta-title">Title</label>

               <input type="checkbox" id="thumbnail" name="kmfcpr_metadata[supports][]'" value="thumbnail" >
                <label for="thumbnail">Thumbnail</label>

                <input type="checkbox" id="editor" name="kmfcpr_metadata[supports][]'" value="editor" >
                <label for="editor">Editor</label>

                <input type="checkbox" id="comments" name="kmfcpr_metadata[supports][]" value="comments" >
                <label for="comments">Comments</label>

                <input type="checkbox" id="custom-fields" name="kmfcpr_metadata[supports][]" value="custom-fields" >
                <label for="custom-fields">Custom Fields</label>


                <input type="checkbox" id="author" name="kmfcpr_metadata[supports][]'" value="author" >
                <label for="author">Author</label>

                <input type="checkbox" id="post-formats" name="kmfcpr_metadata[supports][]" value="post-formats" >
                <label for="post-formats">Post Formats</label>


                <input type="checkbox" id="page-attributes" name="kmfcpr_metadata[supports][]'" value="page-attributes" >
                <label for="page-attributes">Page Attributes</label>
                </div>
                </div>
                </div>
        </div>
    </div>
    <div class="kmfdcpr-field">
        <button type="submit" class="button button-primary">Add New Post Type</button>
    </div>
</div>
