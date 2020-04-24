<?php
/**
 * Plugin Name: Wordpress Skeleton Plugin
 * Plugin URI: https://koriko.pl
 * Description: Simple plugin skeleton from -  <a href ="https://koriko.pl"><strong>Koriko</strong></a> - Made by Paweł Suchodolski
 * Version: 1.0.0
 * Author: Shinoks - Paweł Suchodolski
 * Author URI: https://koriko.pl/
 */

if ( !class_exists( 'wordpressSkeletonPlugin' ) ) {
    $pluginVersion = '1.0';
    $pluginDir = plugin_dir_path( __FILE__ );

    require_once($pluginDir.'class/class.wordpressSkeletonPlugin.php');
    
    add_action( 'widgets_init', 'register_shinoks_widget' );
    function register_shinoks_widget() { 
        register_widget( 'wordpressSkeletonPlugin' ); 
    }
    
    require_once($pluginDir.'includes/menu.php');
    wp_enqueue_style( 'shinoks-test-plugin-style',  plugin_dir_url( __FILE__ ) . 'css/shinoks_test_style.css' );
}