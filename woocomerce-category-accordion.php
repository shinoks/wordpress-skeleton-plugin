<?php
/**
 * Plugin Name: Woocomerce Category Accordion
 * Plugin URI: https://koriko.pl
 * Description: Woocomerce Category Accoridon from -  <a href ="https://koriko.pl"><strong>Koriko</strong></a> - Made by Paweł Suchodolski
 * Version: 1.0.0
 * Author: Shinoks - Paweł Suchodolski
 * Author URI: https://koriko.pl/
 */

if ( !class_exists( 'woocomerceCategoryAccordion' ) ) {
    $pluginVersion = '1.0';
    $pluginDir = plugin_dir_path( __FILE__ );

    require_once($pluginDir.'class/class.woocomerceCategoryAccordion.php');
    
    add_action( 'widgets_init', 'register_shinoks_woocomerce_cat_accorcdion_widget' );
    function register_shinoks_woocomerce_cat_accorcdion_widget() { 
        register_widget( 'woocomerceCategoryAccordion' ); 
    }
    
    wp_enqueue_style( 'shinoks_wc_cat_accordion_style',  plugin_dir_url( __FILE__ ) . 'css/shinoks_wc_cat_accordion_style.css' );
}