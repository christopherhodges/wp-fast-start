<?php

class Media_Folder_Option {

    function __construct() {
        add_action('admin_menu', array($this,'add_settings_menu'));
        /** Load admin js * */
        add_action('admin_enqueue_scripts', array($this, 'loadAdminScripts'));
        /** Load admin css  * */
        add_action('admin_init', array($this, 'addAdminStylesheets'));
        add_action('admin_init', array($this, 'add_option_gallery'));
        add_action('wp_ajax_update_opt', array($this, 'update_opt') );
        
    }
    
    
    public function add_option_gallery(){
        if(!get_option('wpmf_gallery_image_size_value',false)){
            add_option('wpmf_gallery_image_size_value', '["thumbnail","medium","large","full"]');
        }
        if(!get_option('wpmf_padding_masonry',false)){
            add_option('wpmf_padding_masonry', 5);
        }
        
        if(!get_option('wpmf_padding_portfolio',false)){
            add_option('wpmf_padding_portfolio', 10);
        }
        
        if(!get_option('wpmf_usegellery',false)){
            add_option('wpmf_usegellery', 1);
        }
    }


    public function loadAdminScripts() {
        if(isset($_GET['page']) && $_GET['page']=='option-folder'){
            wp_register_script('script-option', plugins_url( '/assets/js/script-option.js', dirname(__FILE__) ));
            wp_enqueue_script('script-option');
        }
    }

 
    public function addAdminStylesheets() {
        wp_enqueue_style('wpmf-setting-style',plugins_url( '/assets/css/setting_style.css', dirname(__FILE__) ));   
    }

    public function add_settings_menu(){
         add_options_page('Setting Folder Options', 'Media Folder', 'manage_options', 'option-folder', array($this,'view_folder_options'));
    }
  
    public function view_folder_options() {
        if(isset($_POST['padding_gallery'])){
            $padding_themes = $_POST['padding_gallery'];
            foreach ($padding_themes as $key => $padding_theme){
                if (!is_numeric($padding_theme)) {
                    if($key == 'wpmf_padding_masonry'){
                        $padding_theme = 5;
                    }else{
                        $padding_theme = 10;
                    }
                }
                $padding_theme = (int) $padding_theme;
                if ($padding_theme > 30 || $padding_theme < 0) {
                    if($key == 'wpmf_padding_masonry'){
                        $padding_theme = 5;
                    }else{
                        $padding_theme = 10;
                    }
                }
                
                $pad = get_option($key);
                if(!isset($pad)){
                    add_option($key, $padding_theme);
                }else{
                    update_option($key, $padding_theme);
                }
            }
        }
        if(isset($_POST['size_value'])){
            $size_value = json_encode($_POST['size_value']);
            if(!get_option('wpmf_gallery_image_size_value',false)){
                add_option('wpmf_gallery_image_size_value', $size_value);
            }else{
                update_option('wpmf_gallery_image_size_value', $size_value);
            }
            $this->get_success_message();
        }
        $padding_masonry = get_option('wpmf_padding_masonry');
        $padding_portfolio = get_option('wpmf_padding_portfolio');
        $size_selected = json_decode(get_option('wpmf_gallery_image_size_value'));
        $usegellery = get_option('wpmf_usegellery');
        require_once( WP_MEDIA_FOLDER_PLUGIN_DIR . 'class/pages/wp-folder-options.php' );
    }
    
    public function get_success_message()
    {
        require_once( WP_MEDIA_FOLDER_PLUGIN_DIR . 'class/pages/saved_info.php' );
    }
    
    public function update_opt(){
        $value = $_POST['value'];
        $usegellery = get_option('wpmf_usegellery');
        if(!isset($usegellery)){
            add_option('wpmf_usegellery', $value);
        }else{
            update_option('wpmf_usegellery', $value);
        }
        $usegellery_after = get_option('wpmf_usegellery');
        wp_send_json($usegellery_after);
    }
    
}