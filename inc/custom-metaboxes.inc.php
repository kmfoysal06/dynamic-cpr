<?php
if(!defined('ABSPATH')){
    exit;
    // exit if accessed directly
}
class KMFDCPR_METS {
    public $name_attr;
    public $field_type;
    public $meta_slug;
    public $meta_slug_og;
    public $meta_title;
    public $meta_id;
    
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
        add_meta_box('kmfdcpr_meta', $this->meta_title, [$this, $this->field_type], 'cpr');
    }
    public function html(){
        wp_nonce_field(basename(__FILE__), 'kmfdcpr_meta_nonce');
      echo '
        <div class="'.esc_attr( "kmfdcpr-field pt" ).'">
            <p>'.esc_html( "Post Type ID" ).'</p>
            <input type="'.esc_attr( "text" ).'" id="'.esc_attr( "pt" ).'" name="'.esc_attr($this->meta_slug_og.'[cpr_id]').'" value="'.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'text','cpr_id')).'" '.esc_html( "required" ).'>
        </div>

        <div class="'.esc_attr( "kmfdcpr-field name" ).'">
            <p>'.esc_html( "Post Type Name" ).'</p>
            <input type="'.esc_attr( "text" ).'" id="'.esc_html( "name" ).'" name="'.esc_attr($this->meta_slug_og.'[cpr_name]').'" value="'.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'text','cpr_name')).'" '.esc_html( "required" ).'>
        </div>

        <div class="'.esc_attr( "kmfdcpr-field ip" ).'">
            <p>'.esc_html("Is Public").'</p>
            <input type="'.esc_attr( "checkbox" ).'" id="'.esc_attr( "ip" ).'" name="'.esc_attr($this->meta_slug_og.'[ip]').'" '.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'select','ip')).'>
            <label for="'.esc_attr( "ip" ).'">'.esc_html('Is Public').'</label>
        </div>

        <div class="'.esc_attr( "kmfdcpr-field su" ).'">
            <input type="'.esc_attr( "checkbox" ).'" id="'.esc_attr( "su" ).'" name="'.esc_attr($this->meta_slug_og.'[su]').'" '.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'select','su')).'>
            <label for="'.esc_attr( "su" ).'">'.esc_html('Show UI').'</label>
        </div>

        <div class="'.esc_attr( "kmfdcpr-field sup" ).'">
                <p>'.esc_html( "Supports" ).'</p>
                <div class="'.esc_attr( "inputs" ).'">
                <input type="'.esc_attr( "checkbox" ).'" id="'.esc_attr( "meta-title" ).'" name="'.esc_attr($this->meta_slug_og.'[supports][]').'" value="'.esc_attr( "title" ).'" ' .esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','title')).'>
                <label for="'.esc_attr( "meta-title" ).'">'.esc_html('Title').'</label>

               <input type="'.esc_attr( "checkbox" ).'" id="'.esc_attr( "thumbnail" ).'" name="'.esc_attr($this->meta_slug_og.'[supports][]').'" value="thumbnail" '.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','thumbnail')).'>
                <label for="'.esc_attr( "thumbnail" ).'">'.esc_html('Thumbnail').'</label>

                <input type="'.esc_attr( "checkbox" ).'" id="'.esc_attr( "editor" ).'" name="'.esc_attr($this->meta_slug_og.'[supports][]').'" value="'.esc_attr( "editor" ).'" '.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','editor')).'>
                <label for="'.esc_attr( "editor" ).'">'.esc_html('Editor').'</label>

                <input type="'.esc_attr( "checkbox" ).'" id="'.esc_attr( "comments" ).'" name="'.esc_attr($this->meta_slug_og.'[supports][]').'" value="'.esc_attr( "comments" ).'" '.$this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','comments').'>
                <label for="'.esc_attr( "comments" ).'">'.esc_html('Comments').'</label>

                <input type="'.esc_attr( "checkbox" ).'" id="'.esc_attr( "page-attributes" ).'" name="'.esc_attr($this->meta_slug_og.'[supports][]').'" value="'.esc_attr( "page-attributes" ).'" '.esc_attr($this->get_the_saved_value(get_the_ID(),$this->meta_slug_og,'multi_select','supports','page-attributes')).'<label for="'.esc_attr( "page-attributes" ).'">'.esc_html('Page Attributes').'</label>
                </div>
        </div>';
}


    public function save_metabox($post_id) {
         if (wp_is_post_revision($post_id) || defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || wp_is_post_autosave($post_id) ){
            return;
            }
        $this->meta_id = $post_id;
        // Check if nonce is set.
        if (!isset($_POST['kmfdcpr_meta_nonce'])) {
            return;
        }
        // Verify nonce.
        if (!wp_verify_nonce(sanitize_text_field($_POST['kmfdcpr_meta_nonce']), basename(__FILE__))) {
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
        //Check if the input is not empty
        if(empty($_POST[$this->meta_slug_og]['cpr_id']) || empty($_POST[$this->meta_slug_og]['cpr_name'])){
            return;
        }

        
        update_post_meta($post_id,$this->meta_slug_og, $this->sanitize_array($_POST[$this->meta_slug_og]));
    }

    public function get_the_saved_value($id,$slug,$type,$key,$needle=false){
        $dbs = get_post_meta($id,$slug,true);
        return sanitize_text_field($this->sanitize_data($dbs,$key,$type,$needle));
    }

    public function sanitize_data($data,$data_key,$type,$neddle_for_multiselect=false){
                if(is_array($data)){
                    switch($type){
                    case 'text':
                        if(array_key_exists($data_key, $data) && $data[$data_key] !== null){
                            return $data[$data_key];
                        }
                        break;
                    case 'select':
                        if(array_key_exists($data_key, $data) && $data[$data_key] !== null){
                            return $data[$data_key] == 'on' ? 'checked' : '' ;
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
                        default:
                            return '';
                        break;
                         }
                }
        }
    
        public function sanitize_array($input_array){
            if(is_array($input_array)){
                return array_map([$this,'sanitize_array'], $input_array);
            }else{
                return is_scalar($input_array) ? sanitize_text_field($input_array) : $input_array ;
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
if(class_exists('KMFDCPR_METS')){
    // Set a unique prefix for the metabox
  $slug = 'kmfcpr_metadata';

  // Create a metabox
  KMFDCPR_METS::createMetabox($slug, [
    'title'     => 'Register Post Type',
    'field' => 'html',
    'name' => 'kmf-name'
  ] );

}