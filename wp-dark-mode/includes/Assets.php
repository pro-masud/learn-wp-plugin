<?php 
namespace Promasud\WpDarkMode;

class Assets{

    function __construct(){
        add_action( 'wp_enqueue_scripts', [ $this, 'dark_mode_enqueue_assets_file' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'dark_mode_enqueue_assets_file' ] ); 
        
        add_action( 'wp', [ $this, 'wp_dark_mode_init' ] );
        add_action( 'wp', [ $this, 'wp_dark_mode_postion' ] );
    }

    public function wp_dark_mode_js_assets_file(){
        return [
            'wp-dark-mode-js' => [ // Correct handle
                'src'       => WP_DARK_MODE_ASSETS . '/js/darkmode-js.min.js',
                'version'   => filemtime( WP_DARK_MODE_PATH . '/assets/js/darkmode-js.min.js' ),
                'deps'      => [ 'jquery' ]
            ]
        ];
    }
    
    public function wp_dark_mode_style_assets_file(){
        return [
            'wp-dark-mode-css' => [ // Correct handle
                'src'       => WP_DARK_MODE_ASSETS . '/css/blockout.css',
                'version'   => filemtime( WP_DARK_MODE_PATH . '/assets/css/blockout.css' ),
            ],
        ];
    }
    

    public function dark_mode_enqueue_assets_file(){
        $style_files = $this->wp_dark_mode_style_assets_file();
        foreach( $style_files as $handle => $style){
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;
            wp_register_style( $handle, $style['src'], $deps, $style['version'] ); // Enqueue instead of just register
        }
    
        $script_files = $this->wp_dark_mode_js_assets_file();
        foreach( $script_files as $handle => $script){
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;
            wp_register_script( $handle, $script['src'], $deps, $script['version'], true ); // Enqueue instead of just register
        }
    }
    
    public function wp_dark_mode_postion(){
        $wp_dark_mode_option = get_option('wp_dark_mode_options');



        $wp_dark_mode_wyotwb_section = $wp_dark_mode_option['wp_dark_mode_wyotwb_section'];

        if(1 == $wp_dark_mode_wyotwb_section){
            $wp_dark_mode_toggle = 'const darkmode = new Darkmode(options)';
        }else{
            $wp_dark_mode_toggle = 'const darkmode = new Darkmode(options).showWidget()';
        }
    }

    public function wp_dark_mode_init(){
        $wp_dark_mode_option = get_option('wp_dark_mode_options');
        
        if( 1 == $wp_dark_mode_option['wp_dark_mode_sipo_section'] ){
            if( is_single() ){
                wp_enqueue_script( 'wp-dark-mode-js' );
                wp_enqueue_style( 'wp-dark-mode-css' );
            }
        }else{
            wp_enqueue_script( 'wp-dark-mode-js' );
            wp_enqueue_style( 'wp-dark-mode-css' );
        }
    }
}