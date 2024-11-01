<?php

/*
* Plugin Name:       Constellation
* Plugin URI:        https://www.syncly.it/constellation/
* Description:       Boost WooCommerce with smart tools.
* Version:           1.1.0
* Text Domain:       smart-tools-for-woocommerce
* Domain Path:       /languages 
* Author:            Syncly.it
* Author URI:        https://www.syncly.it/constellation/
*/
/*
    Copyright 2022  Syncly.it
*/
/**
 * Plugin Name: Constellation
 * .....
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'stw_fs' ) ) {
    stw_fs()->set_basename( false, __FILE__ );
} else {
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    if ( !function_exists( 'stw_fs' ) ) {
        // ... Freemius integration snippet ...
        
        if ( !function_exists( 'stw_fs' ) ) {
            // Create a helper function for easy SDK access.
            function stw_fs()
            {
                global  $stw_fs ;
                
                if ( !isset( $stw_fs ) ) {
                    // Include Freemius SDK.
                    require_once dirname( __FILE__ ) . '/freemius/start.php';
                    $stw_fs = fs_dynamic_init( array(
                        'id'             => '9067',
                        'slug'           => 'stwc',
                        'type'           => 'plugin',
                        'public_key'     => 'pk_5228495785b3a0926bbda4bd733c2',
                        'is_premium'     => false,
                        'has_addons'     => false,
                        'has_paid_plans' => true,
                        'menu'           => array(
                        'slug'    => 'stwc-home',
                        'contact' => false,
                        'support' => false,
                    ),
                        'is_live'        => true,
                    ) );
                }
                
                return $stw_fs;
            }
            
            // Init Freemius.
            stw_fs();
            // Signal that SDK was initiated.
            do_action( 'stw_fs_loaded' );
        }
    
    }
    // ... Your plugin's main file logic ...
    defined( 'ABSPATH' ) or die( "you do not have access to this page!" );
    define( 'STWC__VERSION', '1.0.9' );
    define( 'STWC__DB_VERSION', '1.0.0' );
    define( 'STWC_URL', plugin_dir_url( __FILE__ ) );
    define( 'STWC_PATH', plugin_dir_path( __FILE__ ) );
    define( 'STWC_BASENAME', plugin_basename( __FILE__ ) );
    define( 'STWC_PRODUCT_NAME', 'Smart Tools for WooCommerce' );
    define( 'STWC_UPGRADE_URL', 'https://www.syncly.it/constellation/plans/' );
    define( 'STWC_SUPPORT_URL', 'https://www.syncly.it' );
    require_once STWC_PATH . 'includes/stwc_functions.php';
    require_once STWC_PATH . 'includes/stwc_settings.php';
    require_once STWC_PATH . 'includes/stwc_process.php';
    register_activation_hook( __FILE__, 'stwc_activation' );
    register_deactivation_hook( __FILE__, 'stwc_deactivation' );
    register_uninstall_hook( __FILE__, 'stwc_uninstall' );
    add_action( 'init', 'stwc_load_textdomain' );
    function stwc_load_textdomain()
    {
        load_plugin_textdomain( 'stwc', false, dirname( STWC_BASENAME ) . '/languages' );
    }
    
    add_action( 'plugins_loaded', 'stwc_loaded' );
    function stwc_loaded()
    {
        add_filter(
            'plugin_action_links',
            'stwc_add_action_links',
            10,
            2
        );
        add_filter(
            'plugin_row_meta',
            'stwc_add_support_links',
            10,
            4
        );
        if ( is_admin() ) {
            $settings = new stwc_settings();
        }
    }
    
    // used when upgrading the plan to refresh the menu before redirecting
    stw_fs()->add_action(
        'after_account_connection',
        'stw_fs_after_account_connection',
        10,
        2
    );
    function stw_fs_after_account_connection( FS_User $user, FS_Site $site )
    {
        if ( is_admin() ) {
            $settings = new stwc_settings();
        }
    }
    
    // end of code for refreshing the menu
    function stwc_activation()
    {
        stwc_activation_check();
        stwc_configure_db();
    }
    
    function stwc_deactivation()
    {
        //no temp files to be removed
    }
    
    function stwc_uninstall()
    {
        stwc_clear_db();
    }

}
