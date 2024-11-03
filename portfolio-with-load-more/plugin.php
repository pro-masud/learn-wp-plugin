<?php 
    /**
     * Plugin Name: Portfolio with Load More
     * version: 1.0.0
     * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
     * Author: MR9
     * Author URI: promasudbd@gmail.com
     * Text Domain: portfolio
     * Domain Path:/language
     * */ 

    /** Portfolio version */ 
    define('PORT_LOAD_MORE_VERSION', '1.0.0');

    /** Portfolio Directory Path Version */
    define('PORTFOLIO_HELPER_DIR', trailingslashit(plugin_dir_path( __FILE__ )));

    /** Portfolio includes directory path */ 
    define("PORTFOLIO_HELPER_INCLUDES_DIR", trailingslashit( PORTFOLIO_HELPER_DIR . 'includes' ));

    // create a plugin main Class
    class PortfolioLoadMore{
        // create a plugin construct function
        public function __construct(){
            add_action("plugins_loaded", array($this, 'Portfolio_Text_Domain_loaded' ));
            add_action('wp_enqueue_scripts', array($this, 'Portfolio_Assets_Files'));

            // Custom Post Type Included
            $this->Custom_Post_Type_Ragister();

            // create a custom shortcode here
            add_shortcode('portfolio', array($this, 'portfolio_short_code'));

            add_action('wp_ajax_loadmore',array($this,'load_ajax_data'));
            add_action('wp_ajax_nopriv_loadmore',array($this,'load_ajax_data'));
        }


        public function load_ajax_data(){

            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => $_POST['postNumber'],
                'paged' => $_POST['page'] + 1
            );
            $query = new WP_Query( $args );
            
            if( $query->have_posts() ):
                while( $query->have_posts() ): $query->the_post();
                $terms = get_the_terms( get_the_ID(), 'category' );
                $cat = array();
                $id = '';
                if( $terms ){
                    foreach( $terms as $term ){
                        $cat[] = $term->name.' ';
                        $slug = $term->slug;
                        $id  .= ' '.$term->slug.'-'.$term->term_id;
                    }
                }
         ?>
            <div class="portfolio-item <?php echo  $slug; ?>">
                <a href="<?php the_permalink();?>" class="portfolio-image popup-gallery" title="Bread">
                    <img src="<?php the_post_thumbnail_url()?>" alt="">
                    <div class="portfolio-hover-title">
                        <div class="portfolio-content">
                            <h4><?php the_title();?></h4>
                            <div class="portfolio-category">
                                <span><?php echo $slug;?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                endwhile;
              endif;
            
        }

        // portfolio shortcode here
        public function portfolio_short_code(){
            ob_start();
            ?>
            <div class="section bg-white pt-2 pb-2 text-center" data-aos="fade">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <ul class="portfolio-filter text-center">
                                    <li class="active">
                                        <a href="#" data-filter="*"><?php esc_html_e('All', 'portfolio' ) ?></a>
                                    </li>
                                    <?php 
                                        $categorys = get_terms(
                                        "category", array(
                                                'hide_empty' => true,
                                            )
                                        );

                                        if(!empty($categorys) ){
                                            foreach( $categorys as $category): ?>
                                                <li>
                                                    <a href="#" data-filter=".<?php echo $category->slug; ?>">
                                                        <?php echo $category->name; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach;
                                        }
                                    ?>
                                </ul>
                            </div>

                            <div class="portfolio-grid portfolio-gallery grid-4 gutter">
                                    
                            <?php
                                $args = array(
                                    'post_type' => 'portfolio',
                                    'posts_per_page' => 2,
                                );

                                $query = new WP_Query( $args );

                                // Localize
                                wp_localize_script(
                                    'portfolio-js',
                                    'galleryloadajax',
                                    array(
                                        'action_url' => admin_url( 'admin-ajax.php' ),
                                        'current_page' => ( get_query_var('paged') ) ? get_query_var('paged') : 1,
                                        'posts' => json_encode( $query->query_vars ),
                                        'max_pages' => $query->max_num_pages,
                                        'postNumber' => 2,
                                        'col' => 3,
                                        'btnLabel' => esc_html__( 'Load More', 'textdomain' ),
                                        'btnLodingLabel' => esc_html__( 'Loading....', 'textdomain' ),
                                    )
                                );

                                if( $query->have_posts() ):
                                    while( $query->have_posts() ):
                                    $query->the_post();
                                    $terms = get_the_terms( get_the_ID(), 'category' );
                                    $cat = array();
                                    $id = '';

                                    if( $terms ){
                                        foreach( $terms as $term ){
                                            $cat[] = $term->name.' ';
                                            $slug = $term->slug;
                                            $id  .= ' '.$term->slug.'-'.$term->term_id;
                                        }
                                    }
                                    ?>
                                        <div class="portfolio-item <?php  
                                                echo $slug;
                                            ?> ">
                                            <a href="<?php the_permalink(); ?>" class="portfolio-image popup-gallery" title="Bread">
                                                <?php the_post_thumbnail(); ?>
                                                <div class="portfolio-hover-title">
                                                    <div class="portfolio-content">
                                                        <h4><?php echo the_title(); ?></h4>
                                                        <div class="portfolio-category">
                                                            <?php  foreach($terms as $term){ ?>
                                                                <span><?php echo esc_html($term -> name); ?></span>
                                                            <?php  } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                            endwhile;
                                            wp_reset_postdata();
                                            echo "<div class='dataload'></div>";
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="portfolio--footer mt-5">
                <div class="load-more-btn">
                    <a class="btn loadAjax btn-default">
                        <?php esc_html_e( 'Load More', 'porfolio' ); ?>
                    </a>
                </div>
            </div>
            
            <?php
            return ob_get_clean();
        }

        // Register Custom Post Types
        private function Custom_Post_Type_Ragister(){
            include PORTFOLIO_HELPER_INCLUDES_DIR . "/Custom-Post-Types.php";
        }

        /** Plugin Text Domain Loaded fuction */
        public function Portfolio_Text_Domain_loaded(){
            load_plugin_textdomain('portfolio', false, trailingslashit( PORTFOLIO_HELPER_DIR . 'language' ) );
        }

        // Plugin Included All CSS and JS file included here
        public function Portfolio_Assets_Files(){
            // plugin css file include 
            wp_enqueue_style('portfolio-bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css', null,  PORT_LOAD_MORE_VERSION );
            wp_enqueue_style('portfolio-css', plugin_dir_url( __FILE__ ) . 'assets/css/portfolio.css', null, PORT_LOAD_MORE_VERSION );

            // Plugin JS file Include
            wp_enqueue_script('portfolio-bootstrap', plugin_dir_url( __FILE__ ) . "assets/js/bootstrap.min.js", ['jquery'], PORT_LOAD_MORE_VERSION, true );
            wp_enqueue_script('portfolio-isotope', plugin_dir_url( __FILE__ ) . "assets/js/isotope.pkgd.min.js", ['jquery'], PORT_LOAD_MORE_VERSION, true );
            wp_enqueue_script('portfolio-js', plugin_dir_url( __FILE__ ) . "assets/js/portfolio.js", [ 'jquery', 'portfolio-isotope' ], PORT_LOAD_MORE_VERSION, true );
        }
    }

    new PortfolioLoadMore();