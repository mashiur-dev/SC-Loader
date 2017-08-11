<?php
/*
Plugin Name: Sc Loader
Plugin URI: http://stylishcreativity.com
Author: Mashiur Rahman
Author URI: http://stylishcreativity.com
*/

// include admin option
require_once('scloader-options.php');

// load all style and scripts
function scloader_styles_and_script() {
    wp_enqueue_script( 'jquery' );
    
    // Register the style for plugin:
    wp_register_style( 'scloader-style', plugins_url( '/css/scloader-style.css', __FILE__ ), array(), 'all' );
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'scloader-style' );
    
    // Register the script for plugin:
    wp_register_script('scloader_main_script', plugins_url( '/js/scloader-plugin.js', __FILE__ ), array('jquery'),'1.0', true);
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('scloader_main_script');
}
add_action('wp_enqueue_scripts', 'scloader_styles_and_script' );


//adding the loader html in website
function custom_content_after_body_open_tag() {
    ?>
    
    <div id="scloader_main">
        <img src="<?php echo plugins_url( '/loaders/Preloader_'. get_option( 'select-loader' ) .'.gif', __FILE__ ); ?>">
    </div>

    <?php

}

add_action('wp_footer', 'custom_content_after_body_open_tag');