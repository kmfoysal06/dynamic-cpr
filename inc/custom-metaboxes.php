<?php
class METS {
    public $name_attr;
    public $field_type;
    public $meta_slug;
    public $meta_title;
    public $meta_id;

    // public function __construct($name,$field,$slug,$title) {
    //  $this->name = $name;
    //  $this->slug = $slug;
    //  $this->field_type = $this->init_field($field);
    //  $this->meta_title = $title ;
    //     add_action("add_meta_boxes", [$this, 'create_metabox']);
    //     add_action("save_post", [$this, 'save_metabox']);
    // }
    public function init_field($field){
        switch ($field) {
            case 'text':
                return 'textField';
                break;
            
            default:
                return 'html';
                break;
        }

    }
    public function create_metabox() {
        add_meta_box('kmf_meta', $this->meta_title, [$this, $this->field_type], 'cpr');
    }

    // public function textField() {
    //     wp_nonce_field(basename(__FILE__), 'kmf_meta_nonce');
    //     echo "
    //     <input type='text' id='kmf_metabox' name='".$this->name_attr."' value='" . esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug,$this->field_type)) . "' >
    //     ";
    // }
    public function html(){
        wp_nonce_field(basename(__FILE__), 'kmf_meta_nonce');
      echo '
<div class="kmf-cpr-field pt">
            <p>Post Type ID</p>
            <input type="text" id="pt" name="'.$this->meta_slug.'[cpr_id]" value='.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'greatfullField','cpr_id')).'>
        </div>

        <div class="kmf-cpr-field name">
            <p>Post Type Name</p>
            <input type="text" id="name" name="'.$this->meta_slug.'[cpr_name]" value='.esc_attr($this->get_the_saved_value(get_the_ID(),'cpr-title','textField','cpr_name')).'>
        </div>

        <div class="kmf-cpr-field ip">
            <p>Is Public</p>
            <input type="checkbox" id="ip" name="ip" '.esc_attr($this->get_the_saved_value(get_the_ID(),'cpr-is-public','checkBoxField')).'>
        </div>

        <div class="kmf-cpr-field su">
            <p>Show UI</p>
            <input type="checkbox" id="su" name="su" '.esc_attr($this->get_the_saved_value(get_the_ID(),'cpr-show-ui','checkBoxField')).'>
        </div>

        <div class="kmf-cpr-field sup">
                <p>Supports</p>
                <div class="inputs">
                <input type="checkbox" id="meta-title" name="supports[]" value="title" '.esc_attr($this->get_the_saved_value(get_the_ID(),'cpr-supports','multiCheckBoxField','title')).'>
                <label for="meta-title">Title</label>

                <input type="checkbox" id="thumbnail" name="supports[]" value="thumbnail" '.esc_attr($this->get_the_saved_value(get_the_ID(),'cpr-supports','multiCheckBoxField','thumbnail')).'>
                <label for="thumbnail">Thumbnail</label>

                <input type="checkbox" id="editor" name="supports[]" value="editor" '.esc_attr($this->get_the_saved_value(get_the_ID(),'cpr-supports','multiCheckBoxField','editor')).'>
                <label for="editor">Editor</label>

                <input type="checkbox" id="comments" name="supports[]" value="comments" '.esc_attr($this->get_the_saved_value(get_the_ID(),'cpr-supports','multiCheckBoxField','comments')).'>
                <label for="comments">Comments</label>

                <input type="checkbox" id="page-attributes" name="supports[]" value="page-attributes" '.esc_attr($this->get_the_saved_value(get_the_ID(),'cpr-supports','multiCheckBoxField','page-attributes')).'>
                <label for="page-attributes">Page Attributes</label>
                </div>
        </div>';
        echo var_dump($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'greatfullField','cpr_id')); 
    }

    public function save_metabox($post_id) {
        $this->meta_id = $post_id;
        // Check if nonce is set.
        if (!isset($_POST['kmf_meta_nonce'])) {
            return;
        }
        // Verify nonce.
        if (!wp_verify_nonce($_POST['kmf_meta_nonce'], basename(__FILE__))) {
            return;
        }
        // Check if this is an autosave.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // Check permissions.
        if ('post' === $_POST['post_type']) {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }
        // Update the meta field in the database.
        // update_post_meta($post_id,'cpr-id', $_POST['cpr-post-id']);
        // update_post_meta($post_id,'cpr-title', $_POST['cpr-name']);
        update_post_meta($post_id,$this->meta_slug_og, $_POST[$this->meta_slug_og]);
        update_post_meta($post_id,'cpr-is-public', $_POST['ip']);
        update_post_meta($post_id,'cpr-show-ui', $_POST['su']);
        update_post_meta($post_id,'cpr-supports', $_POST['supports']);
    }

    public function get_the_saved_value($id,$slug,$type,$needle=false){
        switch ($type) {
            case 'textField':
                return get_post_meta($id,$slug,true) !== null ? get_post_meta($id,$slug,true) : '' ;
                break;
            case 'checkBoxField':
            return (!empty(get_post_meta($id,$slug,true) ) && get_post_meta($id,$slug,true) == true && get_post_meta($id,$slug,true) !== null)? 'checked' : '' ;
            break;
            case 'multiCheckBoxField':
            return (!empty(get_post_meta($id,$slug,true) ) && in_array($needle, get_post_meta($id,$slug,true)) && get_post_meta($id,$slug,true) !== null)? 'checked' : '' ;
            break;
            
            default:
                return get_post_meta($id,$slug,true) !== null ? get_post_meta($id,$slug,true) : '' ;
                break;
        }
        
    }
    public static function createMetabox(string $slug,array $data){
        global $post;
        if(empty($slug) || empty($data)){
            return;
        }
        $instance = new self();
        $instance->meta_slug = $slug.'[]';
        $instance->meta_slug_og = $slug;
        $instance->name_attr = $data['name'];
        $instance->field_type = $instance->init_field($data['field']);
        $instance->meta_title = $data['title'] ;
        add_action("add_meta_boxes", [$instance,'create_metabox']);
        add_action("save_post", [$instance,'save_metabox']);

    }
}

// new METS('kmf-name','text','kmf-meta');
if(class_exists('METS')){
    // Set a unique prefix for the metabox
  $slug = 'kmf_custom_post_meta_2';

  // Create a metabox
  METS::createMetabox($slug, [
    'title'     => 'Title Of Metabox',
    'field' => 'html',
    'name' => 'kmf-name'
  ] );

}