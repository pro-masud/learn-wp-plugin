<?php 
namespace Promasud\WpDarkMode;

class Assets {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'dark_mode_enqueue_assets_file' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'dark_mode_enqueue_assets_file' ] ); 
        
        add_action( 'wp', [ $this, 'wp_dark_mode_init' ] );
        add_action( 'wp', [ $this, 'wp_dark_mode_position' ] );
    }

    /**
     * Returns JavaScript files with versioning.
     */
    public function wp_dark_mode_js_assets_file() {
        return [
            'wp-dark-mode-js' => [
                'src'     => WP_DARK_MODE_ASSETS . '/js/darkmode-js.min.js',
                'version' => file_exists( WP_DARK_MODE_PATH . '/assets/js/darkmode-js.min.js' ) ? 
                             filemtime( WP_DARK_MODE_PATH . '/assets/js/darkmode-js.min.js' ) : WP_DARK_MODE_VERSION,
                'deps'    => [ 'jquery' ]
            ]
        ];
    }
    
    /**
     * Returns CSS files with versioning.
     */
    public function wp_dark_mode_style_assets_file() {
        return [
            'wp-dark-mode-css' => [
                'src'     => WP_DARK_MODE_ASSETS . '/css/blockout.css',
                'version' => file_exists( WP_DARK_MODE_PATH . '/assets/css/blockout.css' ) ? 
                             filemtime( WP_DARK_MODE_PATH . '/assets/css/blockout.css' ) : WP_DARK_MODE_VERSION,
            ]
        ];
    }
    
    /**
     * Enqueues styles and scripts.
     */
    public function dark_mode_enqueue_assets_file() {
        $style_files = $this->wp_dark_mode_style_assets_file();
        foreach ( $style_files as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : [];
            wp_enqueue_style( $handle, $style['src'], $deps, $style['version'] );
        }
    
        $script_files = $this->wp_dark_mode_js_assets_file();
        foreach ( $script_files as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : [];
            wp_enqueue_script( $handle, $script['src'], $deps, $script['version'], true );
        }
    }

    /**
     * Initializes dark mode widget position and styles.
     */
    public function wp_dark_mode_position() {
        $wp_dark_mode_option = get_option( 'wp_dark_mode_options', [] );

        if ( empty( $wp_dark_mode_option ) ) {
            return;
        }

        // Define default settings
        $wp_dark_mode_button_dark_settings  = '#000';
        $wp_dark_mode_button_light_settings = '#fff';
        $wp_dark_mode_toggle                = 'const darkmode = new Darkmode(options).showWidget();';
        $wp_dark_mode_bottom                = '32px';
        $wp_dark_mode_right                 = '32px';
        $wp_dark_mode_left                  = 'unset';
        $wp_dark_mode_time                  = '0.3s';
        $wp_dark_mode_cookies               = isset($wp_dark_mode_option['wp_dark_mode_cookie']) ? 'true' : 'false';
        $wp_dark_mode_match_os              = isset($wp_dark_mode_option['wp_dark_mode_match_os']) ? 'true' : 'false';

        // Customize settings based on options
        if ( ! empty( $wp_dark_mode_option['wp_dark_mode_bottom'] ) ) {
            $wp_dark_mode_bottom = $wp_dark_mode_option['wp_dark_mode_bottom'];
        }

        if ( ! empty( $wp_dark_mode_option['wp_dark_mode_right'] ) ) {
            $wp_dark_mode_right = $wp_dark_mode_option['wp_dark_mode_right'];
        }

        $wp_dark_mode_custom_js = "
        var options = {
            bottom: '{$wp_dark_mode_bottom}', 
            right: '{$wp_dark_mode_right}', 
            left: '{$wp_dark_mode_left}', 
            time: '{$wp_dark_mode_time}', 
            buttonColorDark: '{$wp_dark_mode_button_dark_settings}', 
            buttonColorLight: '{$wp_dark_mode_button_light_settings}', 
            saveInCookies: '{$wp_dark_mode_cookies}', 
            autoMatchOsTheme: '{$wp_dark_mode_match_os}', 
            label: '🌓'
        };
        {$wp_dark_mode_toggle}
        ";

        wp_add_inline_script( 'wp-dark-mode-js', wp_json_encode( $wp_dark_mode_custom_js) );
    }

    /**
     * Conditionally loads dark mode on single posts.
     */
    public function wp_dark_mode_init() {
        $wp_dark_mode_option = get_option( 'wp_dark_mode_options', [] );

        if ( isset( $wp_dark_mode_option['wp_dark_mode_sipo_section'] ) && 
             $wp_dark_mode_option['wp_dark_mode_sipo_section'] && is_single() ) {
            wp_enqueue_script( 'wp-dark-mode-js' );
            wp_enqueue_style( 'wp-dark-mode-css' );
        } else {
            wp_enqueue_script( 'wp-dark-mode-js' );
            wp_enqueue_style( 'wp-dark-mode-css' );
        }
    }
}
