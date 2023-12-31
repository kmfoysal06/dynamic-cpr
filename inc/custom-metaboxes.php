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
            <input type="text" id="pt" name="'.$this->meta_slug_og.'[cpr_id]" value="'.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'text','cpr_id').'">
        </div>

        <div class="kmf-cpr-field name">
            <p>Post Type Name</p>
            <input type="text" id="name" name="'.$this->meta_slug_og.'[cpr_name]" value="'.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'text','cpr_name').'">
        </div>

        <div class="kmf-cpr-field ip">
            <p>Is Public</p>
            <input type="checkbox" id="ip" name="'.$this->meta_slug_og.'[ip]" '.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'select','ip').'>
        </div>

        <div class="kmf-cpr-field su">
            <p>Show UI</p>
            <input type="checkbox" id="su" name="'.$this->meta_slug_og.'[su]" '.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'select','su').'>
        </div>

        <div class="kmf-cpr-field sup">
                <p>Supports</p>
                <div class="inputs">
                <input type="checkbox" id="meta-title" name="'.$this->meta_slug_og.'[supports][]" value="title" '.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','title').'>
                <label for="meta-title">Title</label>

                <input type="checkbox" id="thumbnail" name="'.$this->meta_slug_og.'[supports][]" value="thumbnail" '.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','thumbnail').'>
                <label for="thumbnail">Thumbnail</label>

                <input type="checkbox" id="editor" name="'.$this->meta_slug_og.'[supports][]" value="editor" '.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','editor').'>
                <label for="editor">Editor</label>

                <input type="checkbox" id="comments" name="'.$this->meta_slug_og.'[supports][]" value="comments" '.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','comments').'>
                <label for="comments">Comments</label>

                <input type="checkbox" id="page-attributes" name="'.$this->meta_slug_og.'[supports][]" value="page-attributes"  '.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','page-attributes').'>
                <label for="page-attributes">Page Attributes</label>
                </div>
        </div>';
        echo var_dump($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','title'));
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
    }

    public function get_the_saved_value($id,$slug,$type,$key,$needle=false){
        $dbs = get_post_meta($id,$slug,true);
        return $this->sanitize_data($dbs,$key,$needle,$type);
    }

    public function sanitize_data($data,$data_key,$neddle_for_multiselect=false,$type){
                switch($type){
                    case 'text':
                        if(array_key_exists($data_key, $data) && $data[$data_key] !== null){
                            return $data[$data_key];
                        }
                        break;
                    case 'select':
                        if(array_key_exists($data_key, $data) && $data[$data_key] !== null){
                            return $data[$data_key] = 'on' ;
                        }
                        break;
                    case 'multi_select':
                        foreach ($data as $key => $assoc_value) {
                            if(is_array($assoc_value) && array_key_exists($key,$assoc_value)){
                                foreach($assoc_value as $value){
                                     array_push($value,$key);
                                }
                            }
                        }
                        return array_key_exists($data_key, $data) ? (is_array($data[$data_key]) && in_array($neddle_for_multiselect, $data[$data_key]) ? 'checked': '') : '';
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