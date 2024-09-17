<?php
    /**
     * Plugin Name: MR9
     * version: 1.0.0
     * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, similique!
     * Author: MR9
     * Author URI: promasudbd@gmail.com
     * Text Domain: mr-9 
     * Domain Path:/language
     * */ 

    /**
     * #-01MR9 Plugin Text Domain loaded user defiends creation
     * #-02 load plugin text domain action hook add
     * 
    */
     add_action("plugins_loaded", "mr9_text_domain_loaded_files");

     function mr9_text_domain_loaded_files(){
        load_plugin_textdomain("mr-9", false, dirname(__FILE__). "./language");
     }

    /**
     * create a new function post count and filter post title
     * */ 

     function mr9_post_title($title): mixed{

      // $title .= " promasud";  //concatanation blog post title
      $title_word_count = str_word_count($title);
      
      //   create a conditional filter post
      $mr9_post_type = get_post_type(get_the_ID()); 

      $get_post_type = apply_filters("apply_filter_within_post", array());

      if(!in_array($mr9_post_type, $get_post_type )){
         return $title;
      }

      //   apply_filter hook dynamic tags here
      $args = apply_filters("new_tags_name", "h4");

        $title .=  sprintf("<%s>%s</%s>", $args, $title_word_count, $args);

        return $title;
     }

     add_action("the_title", "mr9_post_title");
?>
