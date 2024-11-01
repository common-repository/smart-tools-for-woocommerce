<?php
defined('ABSPATH') or die("you do not have access to this page!");

function stwc_activation_check()
{
    if (version_compare(PHP_VERSION, '5.6', '<')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(__('Smart Tools for WooCommerce cannot be activated. The plugin requires PHP 5.6 or higher', 'stwc'));
    }

    global $wp_version;
    if (version_compare($wp_version, '4.6', '<')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(__('Smart Tools for WooCommerce cannot be activated. The plugin requires WordPress 4.6 or higher', 'stwc'));
    }


    // Test to see if WooCommerce is active (including network activated).
    $plugin_path = trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce/woocommerce.php';

    if ( in_array( $plugin_path, wp_get_active_and_valid_plugins() )
        || in_array( $plugin_path, wp_get_active_network_plugins() )) 
    {
        // Custom code here. WooCommerce is active, however it has not 
        // necessarily initialized (when that is important, consider
        // using the `woocommerce_init` action).
    } else{
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(__('Smart Tools for WooCommerce cannot be activated. The plugin requires WooCommerce', 'stwc'));        
    }
}

function stwc_add_action_links($links, $file) {
    if ($file == STWC_BASENAME) {
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page=stwc-home">Settings</a>';        
        //$upgrade_link = '<a style="color:#611F69;font-weight:bold;" href="admin.php?page=stwc-home-pricing">👉 Upgrade</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}

function stwc_add_support_links($links_array, $plugin_file_name, $plugin_data, $status ){    
    if( strpos($plugin_file_name, STWC_BASENAME) !== false ){        
        $new_links = array(
                'support' => '<a href="' . STWC_SUPPORT_URL . '" target="_blank">Support</a>');
         
        $links_array = array_merge( $links_array, $new_links );
    }
 
    return $links_array;    
}


function stwc_configure_db(){
    add_option( 'stwc_activation_date', current_time( 'mysql' ), '', 'yes' ); 
    add_option( 'stwc_version', STWC__VERSION, '', 'yes' ); 
    add_option( 'stwc_db_version', STWC__DB_VERSION, '', 'yes' ); 
    //features
    /*
    add_option( 'stwc_ft_oosn', 0, '', 'yes' );  //Out of Stock Notice
    add_option( 'stwc_ft_dipe', 0, '', 'yes' );  //Display Discount Percentage
    add_option( 'stwc_ft_saba', 0, '', 'yes' );  //Removes On Sale Badge            
    add_option( 'stwc_ft_prsc', 0, '', 'yes' );  //Price Shortcode by ID               *INDIE*
    add_option( 'stwc_ft_csco', 0, '', 'yes' );  //Add Custom Column                   *INDIE*
    add_option( 'stwc_ft_capa', 0, '', 'yes' );  //Skip Cark Page => Buy Now           *PRO*
    add_option( 'stwc_ft_emca', 0, '', 'yes' );  //Send Email on Cancelled Orders      *PRO*    
    add_option( 'stwc_ft_gdpr', 0, '', 'yes' );  //Add GDPR Compliant Checkbox         *BUSINESS*
    add_option( 'stwc_ft_usro', 0, '', 'yes' );  //Set Role upon specific purchase     *BUSINESS*    
    add_option( 'stwc_ft_piva', 0, '', 'yes' );  //Add Partita IVA to Billing          *BUSINESS*
    */
    //edn of features
    
    /*
    global $wpdb;
    $table_name = $wpdb->prefix.'stwc';
    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

    if ( ! $wpdb->get_var( $query ) == $table_name ) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
          stwc_id mediumint(9) NOT NULL AUTO_INCREMENT,
          stwc_name text NOT NULL,
          stwc_value text NOT NULL,
          PRIMARY KEY  (stwc_name)
        ) $charset_collate;";        

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        
        $wpdb->insert( 
            $table_name, 
            array( 
                'stwc_name' => 'install_date', 
                'stwc_value' => current_time( 'mysql' ),                 
            )         

        $wpdb->insert( 
            $table_name, 
            array( 
                'stwc_name' => 'db_version', 
                'stwc_value' => STWC__DB_VERSION,                 
            )                     
        
    }    
    */	
}


function stwc_clear_db(){
    delete_option('stwc_activation_date');
    delete_option('stwc_version');
    delete_option('stwc_db_version');
    //features
    /*
    delete_option( 'stwc_ft_oosn');  //Out of Stock Notice
    delete_option( 'stwc_ft_prsc');  //Price Shortcode by ID    
    delete_option( 'stwc_ft_csco');  //Add Custom Column
    delete_option( 'stwc_ft_dipe');  //Display Discount Percentage
    delete_option( 'stwc_ft_saba');  //Removes On Sale Badge        
    delete_option( 'stwc_ft_capa');  //Skip Cark Page => Buy Now           *PRO*
    delete_option( 'stwc_ft_emca');  //Send Email on Cancelled Orders      *PRO*    
    delete_option( 'stwc_ft_gdpr');  //Add GDPR Compliant Checkbox         *BUSINESS*
    delete_option( 'stwc_ft_usro');  //Set Role upon specific purchase     *BUSINESS*    
    delete_option( 'stwc_ft_piva');  //Add Partita IVA to Billing          *BUSINESS*
    */
    //edn of features       

    /*
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}stwc");    
    */	
}

?>