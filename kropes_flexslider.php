<?php  
/* 
Plugin Name: Kropes FlexSlider 
Description: A simple plugin that integrates FlexSlider (http://www.woothemes.com/flexslider/) with WordPress.
Author: Michal Prokeš 
Version: 0.1 
Author URI: http://michalprokes.cz 
*/  

define('KFS_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );  
define('KFS_NAME', "Kropes FlexSlider");  
define ("KFS_VERSION", "0.1");  
define('KFS_TYPE_NAME', "Slider obrázky");  
define('KFS_TYPE_SINGLE', "Slider obrázek");  
define('KFS_TYPE', 'kropes_fs_image');  


function kropes_flexslider_head(){
  wp_enqueue_script('flexslider', KFS_PATH.'jquery.flexslider-min.js', array('jquery'));  
  wp_enqueue_script('flexslider_init', KFS_PATH.'jquery.flexslider.init.js', array('flexslider'));  
  wp_enqueue_style('flexslider_css', KFS_PATH.'flexslider.css');  
}

function kropes_flexslider_content(){
        $slider= '<div class="flexslider"> <ul class="slides">';  

	$args = array("post_type"=>KFS_TYPE);

	$query= new WP_Query($args);
	// Loop
	while($query->have_posts()):
	     $query->the_post();
	     $id = $query->post->ID;
              $img= get_the_post_thumbnail( get_the_ID(), 'slider-thumb' );  
	      $caption = '<div class="flex-caption"><h2>'.get_the_title().'</h2>'.get_the_content().'</div>';  
	      $slider .= '<li>'.$img.$caption.'</li>';
	endwhile;

        $slider.= '</ul> </div>';  

        return $slider;  
}

function kropes_fs_type_register() {  
    $args = array(  
        'label' => __(KFS_TYPE_NAME),  
        'singular_label' => __(KFS_TYPE_SINGLE),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail')  
       );  
    register_post_type(KFS_TYPE , $args );  
}  
add_action('init', 'kropes_fs_type_register'); 
add_theme_support('post-thumbnails', array(KFS_TYPE));  
?>  
