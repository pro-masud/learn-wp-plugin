<?php 
class Wp_Slider_Option {

    private $options;

   public function __construct(){
       add_action( 'admin_menu', [ $this, 'wp_slider_settings_menus' ]);
       add_action( 'admin_init', [ $this, 'wp_slider_page_init' ]);
    }

    public function wp_slider_settings_menus(){

        $parent_slug = 'edit.php?post_type=wp_slider_carousel';
        $capability = 'manage_options';

        add_submenu_page($parent_slug, __('Settings', 'wp-settings'), __('Settings', 'wp-settings'), $capability, 'wp-slider-setting', [ $this, 'wp_slider_settings_option'] );
    }

    public function wp_slider_settings_option(){
        $this->options = get_option( 'wp_slider_settings' );

        ?>
            <div class="wrap">
                <h1 class="wp-heading-inline" >
                    <?php _e( 'Slider Settings', 'wp-slider' ) ?>
                </h1>
                <form action="options.php" method="post">
                    <?php 
                        settings_fields( 'wp_slider_main_options_group' ); // Ensure the group matches register_setting()
                        do_settings_sections( 'wp-slider-carousel' ); // Ensure this matches add_settings_section() 'page'

                        submit_button();
                    ?>
                </form>
            </div>
        <?php
    }


    public function wp_slider_page_init(){

        register_setting(
        'wp_slider_main_options_group',
        'wp_slider_settings',
        [ $this, 'wp_slider_sanitaize' ]
        );

        add_settings_section( 
            'slider_settings_behaviour', // ID
            __( 'Slider Carousel Behaviour', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_behaviour_header' ),
            'wp-slider-carousel',
        );

        add_settings_field( 
            'interval', // ID
            __( 'Slider Interval (milliseconds)', 'wp-slider' ), // Name
            array( $this, 'interval_callback' ),
            'wp-slider-carousel',
            'slider_settings_behaviour',
        );

        add_settings_field( 
            'show_title', 
            __( 'Show Slider Title?', 'wp-slider' ), 
            array( $this, 'wp_slider_title_callback' ), 
            'wp-slider-carousel', 
            'slider_settings_behaviour'
        );

        add_settings_field( 
            'show_captions', 
            __( 'Show Slider Captions?', 'wp-slider' ), 
            array( $this, 'wp_slider_captions_callback' ), 
            'wp-slider-carousel', 
            'slider_settings_behaviour'
        );

        add_settings_field( 
            'show_slide_controls', 
            __( 'Show Slider Controls?', 'wp-slider' ), 
            array( $this, 'wp_slider_control_callback' ), 
            'wp-slider-carousel', 
            'slider_settings_behaviour'
        );

        add_settings_field( 
            'show_slide_indicators', 
            __( 'Show Slider Indicators?', 'wp-slider' ), 
            array( $this, 'wp_slider_indicators_callback' ), 
            'wp-slider-carousel', 
            'slider_settings_behaviour'
        );

        add_settings_field( 
            'show_slide_order_slide_by', 
            __( 'Order Slide By?', 'wp-slider' ), 
            array( $this, 'wp_slider_show_slide_order_slide_by_callback' ), 
            'wp-slider-carousel', 
            'slider_settings_behaviour'
        );

        add_settings_field( 
            'show_slide_order_by', 
            __( 'Order By?', 'wp-slider' ), 
            array( $this, 'wp_slider_show_slide_show_slide_order_byy_callback' ), 
            'wp-slider-carousel', 
            'slider_settings_behaviour'
        );

        add_settings_field( 
            'show_slide_order_by', 
            __( 'Order By?', 'wp-slider' ), 
            array( $this, 'wp_slider_show_slide_slide_order_byy_callback' ), 
            'wp-slider-carousel', 
            'slider_settings_behaviour'
        );

        add_settings_section( 
            'slider_settings_setup', // ID
            __( 'Slider Carousel Setup', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_header_setup' ),
            'wp-slider-carousel',
        );

        add_settings_section( 
            'slider_settings_button_link', // ID
            __( 'Button Link', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_link_buttons_header' ),
            'wp-slider-carousel',
        );

        add_settings_section( 
            'slider_settings_custom_markup', // ID
            __( 'Custom Markup', 'wp-slider' ), // Name
            array( $this, 'wp_slider_settings_custom_markup_header' ),
            'wp-slider-carousel',
        );
    }

    public function wp_slider_sanitaize( $input ) {
        if (!is_array($input)) return [];
        
        $absint_keys = [];
    
        $sanitized_input = [];
        foreach ($input as $key => $value) {
            $sanitized_input[$key] = in_array($key, $absint_keys, true)
                ? absint($value)
                : sanitize_text_field($value);
        }
    
        return $sanitized_input;
    }
    

    /**
     * WP Slider Behaviour Section 
     * */ 
    public function wp_slider_settings_behaviour_header(){
        echo "<p>Slider Header Section</p>";
    }

    public function interval_callback() {
        printf(
            '<input type="text" id="interval" name="wp_slider_settings[interval]" value="%s" size="15" />',
            isset( $this->options['interval'] ) ? esc_attr( $this->options['interval'] ) : ''
        );
        echo '<p class="description">' . __( 'How long each image shows for before it slides. Set to 0 to disable animation.', 'wp-slider' ) . '</p>';
    }

    public function wp_slider_title_callback() {
        $show_title = isset($this->options['show_title']) ? $this->options['show_title'] : 'true';
        $show_title_t = $show_title === 'true' ? 'selected=selected' : '';
        $show_title_f = $show_title === 'false' ? 'selected=selected' : '';
        
        printf(
            '<select id="show_title" name="wp_slider_settings[show_title]">
                <option value="true" %s>%s</option>
                <option value="false" %s>%s</option>
            </select>',
            esc_attr($show_title_t),
            esc_html__('Show', 'wp-slider'),
            esc_attr($show_title_f),
            esc_html__('Hide', 'wp-slider')
        );
    }

    public function wp_slider_captions_callback() {
        $show_captions = isset($this->options['show_captions']) ? $this->options['show_captions'] : 'true';
        $show_show_control_t = $show_captions === 'true' ? 'selected=selected' : '';
        $show_show_control_f = $show_captions === 'false' ? 'selected=selected' : '';
        
        printf(
            '<select id="show_captions" name="wp_slider_settings[show_captions]">
                <option value="true" %s>%s</option>
                <option value="false" %s>%s</option>
            </select>',
            esc_attr($show_show_control_t),
            esc_html__('Show', 'wp-slider'),
            esc_attr($show_show_control_f),
            esc_html__('Hide', 'wp-slider')
        );
    }

    public function wp_slider_control_callback() {
        $show_control = isset($this->options['show_control']) ? $this->options['show_control'] : 'true';
        $show_show_captions_t = $show_control === 'true' ? 'selected=selected' : '';
        $show_show_captions_f = $show_control === 'false' ? 'selected=selected' : '';
        
        printf(
            '<select id="show_control" name="wp_slider_settings[show_control]">
                <option value="true" %s>%s</option>
                <option value="false" %s>%s</option>
            </select>',
            esc_attr($show_show_captions_t),
            esc_html__('Show', 'wp-slider'),
            esc_attr($show_show_captions_f),
            esc_html__('Hide', 'wp-slider')
        );
    }
    
    public function wp_slider_indicators_callback() {
        $show_indicators = isset($this->options['show_indicators']) ? $this->options['show_indicators'] : 'true';
        $show_show_indicators_t = $show_indicators === 'true' ? 'selected=selected' : '';
        $show_show_indicators_f = $show_indicators === 'false' ? 'selected=selected' : '';
        
        printf(
            '<select id="show_indicators" name="wp_slider_settings[show_indicators]">
                <option value="true" %s>%s</option>
                <option value="false" %s>%s</option>
            </select>',
            esc_attr($show_show_indicators_t),
            esc_html__('Show', 'wp-slider'),
            esc_attr($show_show_indicators_f),
            esc_html__('Hide', 'wp-slider')
        );
    }
    
    public function wp_slider_show_slide_order_slide_by_callback() {
        $order_slide_by = isset($this->options['show_slide_order_slide_by']) ? $this->options['show_slide_order_slide_by'] : 'true';
        $show_order_slide_by_t = $order_slide_by === 'true' ? 'selected=selected' : '';
        $show_order_slide_by_f = $order_slide_by === 'false' ? 'selected=selected' : '';
        
        printf(
            '<select id="show_slide_order_slide_by" name="wp_slider_settings[show_slide_order_slide_by]">
                <option value="true" %s>%s</option>
                <option value="false" %s>%s</option>
            </select>',
            esc_attr($show_order_slide_by_t),
            esc_html__('Show', 'wp-slider'),
            esc_attr($show_order_slide_by_f),
            esc_html__('Hide', 'wp-slider')
        );
    }

    public function wp_slider_show_slide_slide_order_byy_callback() {
        $show_slide_order_by = isset($this->options['show_slide_order_by']) ? $this->options['show_slide_order_by'] : 'true';
        $show_slide_order_by_t = $show_slide_order_by === 'true' ? 'selected=selected' : '';
        $show_slide_order_by_f = $show_slide_order_by === 'false' ? 'selected=selected' : '';
        
        printf(
            '<select id="show_slide_order_by" name="wp_slider_settings[show_slide_order_by]">
                <option value="true" %s>%s</option>
                <option value="false" %s>%s</option>
            </select>',
            esc_attr(text: $show_slide_order_by_t),
            esc_html__('Ascending', 'wp-slider'),
            esc_attr($show_slide_order_by_f),
            esc_html__('Desending', 'wp-slider')
        );
    }
    
    

    /**
     * WP Slider Setup Section 
     * */ 
    public function wp_slider_settings_header_setup(){
        echo "<p>Slider Header Section</p>";
    }

    /**
     * WP Slider Setup Section  
     * */ 
    public function wp_slider_settings_link_buttons_header(){
        echo "<p>Slider Header Section</p>";
    }

    /**
     * WP Slider Setup Section  
     * */ 
    public function wp_slider_settings_custom_markup_header(){
        echo "<p>Slider Header Section</p>";
    }
}

if(is_admin()){
   $wp_slider_settings_option =  new Wp_Slider_Option();
}