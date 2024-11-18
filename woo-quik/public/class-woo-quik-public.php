<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dev-masud-rana.netlify.app/
 * @since      1.0.0
 *
 * @package    Woo_Quik
 * @subpackage Woo_Quik/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woo_Quik
 * @subpackage Woo_Quik/public
 * @author     Masud Rana <promasudbd@gmail.com>
 */
class Woo_Quik_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.	1Q
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'woocommerce_after_shop_loop_item', [ $this, 'woo_quik_view_shop_page_btn' ] );
		add_action( 'wp_footer', [ $this, 'woo_quik_view_show_model' ]);

		add_action( 'wp_ajax_woo_quik_view_callback', [ $this, 'woo_quik_view_callback' ]);
		add_action( 'wp_ajax_nopriv_woo_quik_view_callback', [ $this, 'woo_quik_view_callback' ]);
	}

	public function woo_quik_view_callback(){
		 if( isset( $_POST['wqv']));

		 $wqvid = intval( $_POST['wqv'] );
		 $args = array(
			'post_type'	=> 'product',
			'posts_per_page'	=> 1,
			'post__in'	=> array( $wqvid )
		);

		$qvproduct = new WP_Query( $args );

		if ($qvproduct->have_posts()) {
            while ($qvproduct->have_posts()) {
                $qvproduct->the_post();
                global $product;
                
                echo '<div class="woo-qview-left">';
                
					// Display the product thumbnail
					if (has_post_thumbnail()) {
						the_post_thumbnail('medium'); // Adjust the size as needed
					}

					// Get and display gallery images
					$qvimgId = $product->get_gallery_image_ids();
					
					if (!empty($qvimgId)) {
						echo '<div class="qv-pgallery">';
							foreach ($qvimgId as $qvimg) {
								$qvimg_src = wp_get_attachment_image_src($qvimg, 'thumbnail');
								if ($qvimg_src) {
									echo '<img src="' . esc_url($qvimg_src[0]) . '" width="' . esc_attr($qvimg_src[1]) . '" height="' . esc_attr($qvimg_src[2]) . '" />';
								}
							}
						echo '</div>';
					}
					echo '</div>';
						echo '<div class="woo-qview-right">';
						do_action('woo_quik_product_details');
				echo '</div>';
            }

			wp_reset_postdata();
			wp_die();
        }
	}

	public function woo_quik_view_shop_page_btn(){
		global $product;
		$option = get_option('woo_quik_view_option');
		
		if( $option['woo_quik_disable_enable_view'] == 'yes'){
			$cat_id = $product->get_id();
			echo '<a href="#" data-id="' . $cat_id . '" class="button product_type_simple add_to_cart_button ajax_add_to_cart mr-3 woo-quick-view-btn">' . __("Quick View", "woo-quik") . '</a>';
		}
	}

	public function woo_quik_view_show_model(){

		?>
			<div class="woo-quik-view-model animate__fadeIn lightSpeedIn">
				<a href="#" id="woo-modal-close">X</a>
				
				<div class="woo-modal-content">

				</div>
			</div>
		<?php
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Quik_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Quik_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name . '-normalize', plugin_dir_url( __FILE__ ) . 'css/normalize.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-animate', plugin_dir_url( __FILE__ ) . 'css/animate.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-quik-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Quik_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Quik_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'woo-quik-public-script', plugin_dir_url( __FILE__ ) . 'js/woo-quik-public.js', array( 'jquery' ), $this->version, true );

		wp_localize_script( 
			'woo-quik-public-script',
			'woo_quik_view',
			[
				'ajaxurl' => admin_url('admin-ajax.php'),
			]
		);

	}

}
