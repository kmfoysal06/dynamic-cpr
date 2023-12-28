<?php
class METS {
    public $name_attr;
    public $field_type;
    public $meta_slug;
    public $meta_title;
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
        wp_nonce_field(basename(__FILE__), $this->meta_slug.'_nonce');
        echo '
        <input type="hidden" name="'.$this->meta_slug.'[]">
<div class="kmf-cpr-field pt">
            <p>Post Type ID</p>
            <input type="text" id="pt" name="'.$this->meta_slug.'[pt]" value='.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug,"rat","pt")).'>
        </div>

        <div class="kmf-cpr-field name">
            <p>Post Type Name</p>
            ';
// <input type="text" id="name" name="'.$this->meta_slug.'[cpr_post_type_title]" value='.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug,"grat","cpr_post_type_title")).'>
    echo'
        </div>

        <div class="kmf-cpr-field ip">
            <p>Is Public</p>
            <input type="checkbox" id="ip" name="ip">
        </div>

        <div class="kmf-cpr-field su">
            <p>Show UI</p>
            <input type="checkbox" id="su" name="su">
        </div>

        <div class="kmf-cpr-field sup">
                <p>Supports</p>
                <div class="inputs">
                <input type="checkbox" id="title" name="supports[]" value="title">
                <label for="title">Title</label>

                <input type="checkbox" id="thumbnail" name="supports[]" value="thumbnail">
                <label for="thumbnail">Thumbnail</label>

                <input type="checkbox" id="editor" name="supports[]" value="editor">
                <label for="editor">Editor</label>

                <input type="checkbox" id="comments" name="supports[]" value="comments">
                <label for="comments">Comments</label>

                <input type="checkbox" id="page-attributes" name="supports[]" value="page-attributes">
                <label for="page-attributes">Page Attributes</label>
                </div>
        </div>' ;
    }

    public function save_metabox($post_id) {
        // Check if nonce is set.
        if (!isset($_POST[$this->meta_slug.'_nonce'])) {
            return;
        }
        // Verify nonce.
        if (!wp_verify_nonce($_POST[$this->meta_slug.'_nonce'], basename(__FILE__))) {
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
        update_post_meta($post_id,$this->meta_slug, $_POST[$this->meta_slug]);
    }

    public function get_the_saved_value($id,$slug,$type,$neddle=false){
        switch ($type) {
            case 'textField':
                return get_post_meta($id,$slug,true) !== null ? get_post_meta($id,$slug,true) : '' ;
                break;
            case 'selectBoxField':
                return get_post_meta($id,$slug,true) !== null ? get_post_meta($id,$slug,true) : '' ;
                break;
            case 'MultiSelectBoxField':
                return get_post_meta($id,$slug,true) !== null ? get_post_meta($id,$slug,true) : '' ;
                break;
            default:
                return get_post_meta($id,$slug,true)[$neddle] !== null ? get_post_meta($id,$slug,true)[$neddle] : '' ;
                break;
        }
        
    }
    public static function createMetabox(string $slug,array $data){
        if(empty($slug) || empty($data)){
            return;
        }
        $instance = new self();
        $instance->meta_slug = $slug;
        $instance->name_attr = $data['name'];
        $instance->field_type = $instance->init_field($data['field']);
        $instance->meta_title = $data['title'] ;
        add_action("add_meta_boxes", [$instance,'create_metabox']);
        add_action("save_post", [$instance,'save_metabox']);
// echo print_r($instance->get_the_saved_value(get_the_ID(),$instance->meta_slug,"grat","cpr_post_type_title"));
    }
}

// new METS('kmf-name','text','kmf-meta');
if(class_exists('METS')){
    // Set a unique prefix for the metabox
  $slug = 'kmf-cpr-meta';

  // Create a metabox
  METS::createMetabox( $slug, [
    'title'     => 'Title Of Metabox',
    'field' => 'html',
    'name' => 'kmf-name'
  ] );

}