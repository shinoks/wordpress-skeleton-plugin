<?php

    add_action( 'admin_menu', 'shinoks_test_to_top_menu' );
    add_action( 'admin_menu', 'shinoks_test_to_sub_menu' );
    
    function shinoks_test_to_top_menu(){
        add_menu_page(
            'Shinoks test Widget',
            'Menu test',
            'manage_options',
            'shinoks-test',
            'shinoks_test_top_level_menu_page',
            '',
            6
        );
    }
    function shinoks_test_top_level_menu_page(){
        echo 'This is my page content';
    }

    function shinoks_test_to_sub_menu() {
        add_submenu_page(
            'shinoks-test',
            'Custom Submenu Page Title',
            'Custom Submenu Page',
            'manage_options',
            'shinoks-test-sub',
            'shinoks_test_sub_menu_page'
        );
    }
    function shinoks_test_sub_menu_page(){
        echo 'This is my sub page content';
    }