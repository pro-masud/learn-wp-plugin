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
    public function wp_dark_mode_postion() {
        $wp_dark_mode_option = get_option('wp_dark_mode_options');

        $wp_dark_mode_button_dark_settings = $wp_dark_mode_option['wp_dark_mode_button_dark_settings'];
        $wp_dark_mode_button_light_settings = $wp_dark_mode_option['wp_dark_mode_button_light_settings'];
    
        $wp_dark_mode_cookies  = "false";
        $wp_dark_mode_match_os = "false";
        $wp_dark_mode_toggle   = "const darkmode = new Darkmode(options).showWidget();";
        $wp_dark_mode_bottom   = "32px";
        $wp_dark_mode_left     = "unset";
        $wp_dark_mode_right    = "32px";
        $wp_dark_mode_time     = "0.3s"; // Default time
    
        if (!empty($wp_dark_mode_option)) {
            $wp_dark_mode_match_os = !empty($wp_dark_mode_option['wp_dark_mode_match_os']) ? 'true' : 'false';
            $wp_dark_mode_cookies  = !empty($wp_dark_mode_option['wp_dark_mode_cookie']) ? 'true' : 'false';
    
            $wp_dark_mode_toggle = !empty($wp_dark_mode_option['wp_dark_mode_wyotwb_section'])
                ? 'const darkmode = new Darkmode(options);'
                : 'const darkmode = new Darkmode(options).showWidget();';
    
            // Custom Position
            $wp_dark_mode_bottom = !empty($wp_dark_mode_option['wp_dark_mode_bottom'])
                ? $wp_dark_mode_option['wp_dark_mode_bottom']
                : $wp_dark_mode_bottom;
    
            $wp_dark_mode_right = !empty($wp_dark_mode_option['wp_dark_mode_right'])
                ? $wp_dark_mode_option['wp_dark_mode_right']
                : $wp_dark_mode_right;
    
            $wp_dark_mode_left = !empty($wp_dark_mode_option['wp_dark_mode_left'])
                ? $wp_dark_mode_option['wp_dark_mode_left']
                : $wp_dark_mode_left;
    
            $wp_dark_mode_time = !empty($wp_dark_mode_option['wp_dark_mode_time'])
                ? $wp_dark_mode_option['wp_dark_mode_time']
                : $wp_dark_mode_time;

            if( 1 == $wp_dark_mode_option['wp_dark_mode_bottom_left']){
                $wp_dark_mode_custom_js = "
                var options = {
                        bottom: '{ $wp_dark_mode_bottom }', // default: '32px'
                        right: 'unset', // default: '32px'
                        left: '{ $wp_dark_mode_left }', // default: 'unset'
                        time: '{ $wp_dark_mode_time }', // default: '0.3s'
                        default: '#100f2c',
                        buttonColorDark: '{ $wp_dark_mode_button_dark_settings }',  // default: '#100f2c'
                        buttonColorLight: { $wp_dark_mode_button_light_settings }, // default: '#fff'
                        saveInCookies: '{$wp_dark_mode_cookies}', // default: true,
                        autoMatchOsTheme: '{$wp_dark_mode_match_os}' // default: true
                        label: '🌓', // default: ''
                        }

                    {$wp_dark_mode_toggle}
                ";

                $wp_dark_layer_css = "
                    .darkmode-layer--button{
                        bottom: '{$wp_dark_mode_bottom}',
                        right: 'unset',
                        left: '{$wp_dark_mode_left}'
                    }
                ";
            }else if( 1 == $wp_dark_mode_option['wp_dark_mode_bottom_right'] ){
                $wp_dark_mode_custom_js = "
                var options = {
                        bottom: '{ $wp_dark_mode_bottom }', // default: '32px'
                        right: '{ $wp_dark_mode_right }', // default: 'unset'
                        left: '{ $wp_dark_mode_left }', // default: '32px'
                        time: '{ $wp_dark_mode_time }', // default: '0.3s'
                        default: '#100f2c',
                        buttonColorDark: '{ $wp_dark_mode_button_dark_settings }',  // default: '#100f2c'
                        buttonColorLight: { $wp_dark_mode_button_light_settings }, // default: '#fff'
                        saveInCookies: '{$wp_dark_mode_cookies}', // default: true,
                        autoMatchOsTheme: '{$wp_dark_mode_match_os}' // default: true
                        label: '🌓', // default: ''
                    }

                    {$wp_dark_mode_toggle}
                ";

                $wp_dark_layer_css = "
                    .darkmode-layer--button{
                        bottom: '{$wp_dark_mode_bottom}',
                        right: '{$wp_dark_mode_right}'
                        left: 'unset',
                    }
                ";
            }else{
                $wp_dark_mode_custom_js = "
                var options = {
                        bottom: '{ $wp_dark_mode_bottom }', // default: '32px'
                        right: '{ $wp_dark_mode_right }', // default: 'unset'
                        left: 'unset', // default: '32px'
                        time: '{ $wp_dark_mode_time }', // default: '0.3s'
                        default: '#100f2c',
                        buttonColorDark: '{ $wp_dark_mode_button_dark_settings }',  // default: '#100f2c'
                        buttonColorLight: { $wp_dark_mode_button_light_settings }, // default: '#fff'
                        saveInCookies: '{$wp_dark_mode_cookies}', // default: true,
                        autoMatchOsTheme: '{$wp_dark_mode_match_os}' // default: true
                        label: '🌓', // default: ''
                    }

                    {$wp_dark_mode_toggle}
                ";

                $wp_dark_layer_css = "
                    .darkmode-layer--button{
                        bottom: '{$wp_dark_mode_bottom}',
                        right: '{$wp_dark_mode_right}'
                        left: 'unset',
                    }
                ";
            }

            wp_add_inline_style( 'wp-dark-mode-css', $wp_dark_layer_css );
            wp_add_inline_script( 'wp-dark-mode-js', $wp_dark_mode_custom_js );
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