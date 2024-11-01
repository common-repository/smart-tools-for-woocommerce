<?php

class stwc_settings
{
    //const UPGRADE_URL = 'https://stwc.syncly.it/pricing';
    const  UPGRADE_URL = 'admin.php?page=stwc-home-pricing' ;
    const  UPGRADE_HTML = ' <sup id="upgrade"><a href="' . self::UPGRADE_URL . '">👉Upgrade</a></sup>' ;
    const  STWC_SUPPORT_URL = 'https://www.syncly.it/' ;
    private  $settings_options ;
    public function __construct()
    {
        //add_action( 'admin_head', 'wpso_add_admin_custom_css', 10, 2 );
        add_action( 'admin_menu', array( $this, 'settings_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'settings_page_init' ) );
    }
    
    public function settings_add_plugin_page()
    {
        add_menu_page(
            'Constellation',
            // page_title
            'Constellation',
            // menu_title
            'manage_options',
            // capability
            'stwc-home',
            // menu_slug
            array( $this, 'create_about_page' ),
            // function
            'dashicons-star-filled',
            // icon_url
            58
        );
        /*
        add_submenu_page(
        	'stwc-home', // parent_slug
        	'About Constellation', //page_title
        	'About', // menu_title
        	'manage_options', // capability
        	'stwc-home', // menu_slug			
            'create_about_page' // function
        );
        */
        add_submenu_page(
            'stwc-home',
            // parent_slug
            'Settings',
            //page_title
            'Settings',
            // menu_title
            'manage_options',
            // capability
            'stwc-home',
            // menu_slug
            array( $this, 'create_sett_page' )
        );
        /*
        add_submenu_page(
        	'stwc-home', // parent_slug
        	'Bulk Coupons', //page_title
        	'<span style="color: rgb(0, 171, 240);">Bulk Coupons</span>', // menu_title
        	'manage_options', // capability
        	'stwc-bulk', // menu_slug			
            array($this,'create_bulk_page') // function
        );			
        */
        /*
        if ( stw_fs()->is_plan('Free', true) ) {
        	add_submenu_page(
        		'stwc-home', // parent_slug
        		'Upgrade', //page_title
        		'<strong style="color: #FCB214;">👉 Upgrade</strong>', // menu_title
        		'manage_options', // capability
        		'stwc-deal', // menu_slug			
        	    array($this,'create_deal_page') // function
        	);										
        }
        */
    }
    
    /*
    function wpso_add_admin_custom_css() {
    	$log  = "2 - " . $text;	    
        file_put_contents(STWC_PATH . './log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
    
        ?>
        <!-- debug -->
        <style type="text/css">
    		#wpadminbar {
    		    background-color : #f1f1f1;
    		}	    
            #wpcontent {background-color: #f0f0f0; }
        </style>
        <?php
    }	
    */
    public function create_sett_page()
    {
        ?>		
		<?php 
        $active_tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'general' );
        $this->settings_options = get_option( 'stwc-settings' );
        ?>

		<script type="text/javascript" src="<?php 
        echo  STWC_URL ;
        ?>/admin/js/stwc_<?php 
        echo  $active_tab ;
        ?>.js"></script>		
		<link href="<?php 
        echo  STWC_URL ;
        ?>/admin/css/style.css" rel="stylesheet" type="text/css">
		<link href="<?php 
        echo  STWC_URL ;
        ?>/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<div class="wrap">					
			<div class="container" style="max-width: 100%;">
				<div class="row" style="padding-top:10px;padding-bottom:10px;">
				    <div class="col-1" style="text-align:center;">
				    	<img src="<?php 
        echo  STWC_URL ;
        ?>/admin/images/stwc-logo.png" alt="STWC Logo" style="width:40px;max-width:40px;">
				    </div>
				    <div class="col-11">
				    	<h2>Constellation: Smart Tools for WooCommerce</h2>	
				    </div>
				</div>		

				<div class="row">
					<div class="col-12">
						<h2 class="nav-tab-wrapper">
							<a href="admin.php?page=stwc-home&tab=general" class="nav-tab <?php 
        echo  ( $active_tab == 'general' ? 'nav-tab-active' : '' ) ;
        ?>">General</a>
							<a href="admin.php?page=stwc-home&tab=shop" class="nav-tab <?php 
        echo  ( $active_tab == 'shop' ? 'nav-tab-active' : '' ) ;
        ?>">Shop</a>
							<!--<a href="admin.php?page=stwc-home&tab=checkout" class="nav-tab <?php 
        //echo $active_tab == 'checkout' ? 'nav-tab-active' : '';
        ?>">Checkout</a>-->
							<a href="admin.php?page=stwc-home&tab=payment" class="nav-tab <?php 
        echo  ( $active_tab == 'payment' ? 'nav-tab-active' : '' ) ;
        ?>">Payment</a>
							<a href="admin.php?page=stwc-home&tab=automation" class="nav-tab <?php 
        echo  ( $active_tab == 'automation' ? 'nav-tab-active' : '' ) ;
        ?>">Automation</a>
							<a href="admin.php?page=stwc-home&tab=about" class="nav-tab <?php 
        echo  ( $active_tab == 'about' ? 'nav-tab-active' : '' ) ;
        ?>">About</a>
						</h2>				    	
					</div>					
				</div>

				<!-- for some odd reason it moves the error/feedback under the <H2> tag -->
				<div class="row">
					<div class="col-12">
						<?php 
        settings_errors();
        ?>
					</div>
				</div>					

				<div class="row">
					<div class="col-12">
						<?php 
        require_once STWC_PATH . 'includes/stwc__wp_template.php';
        ?>
						<form method="post" action="options.php">
							<?php 
        
        if ( $active_tab != 'about' ) {
            echo  "<div class='container' style='max-width: 100%;margin-top:10px;background-color: #f1f1f1 !important; border:solid 1px #3550a0;'><div class='row'><div class='col-6'>" ;
            settings_fields( 'stwc-default' );
        }
        
        
        if ( $active_tab == 'general' ) {
            stwc_settings_sections( 'stwc-general', 3 );
        } else {
            
            if ( $active_tab == 'shop' ) {
                stwc_settings_sections( 'stwc-shop', 3 );
            } else {
                
                if ( $active_tab == 'payment' ) {
                    stwc_settings_sections( 'stwc-payment', 2 );
                } else {
                    if ( $active_tab == 'automation' ) {
                        stwc_settings_sections( 'stwc-automation', 3 );
                    }
                }
            
            }
        
        }
        
        
        if ( $active_tab != 'about' ) {
            echo  "</div></div><div class='row'><div class='col-12'>" ;
            submit_button();
            echo  "</div></div></div>" ;
        }
        
        ?>
						</form>		
						<?php 
        
        if ( $active_tab == 'about' ) {
            ?>
							<div class="container" style="max-width: 100%;padding-top:10px;">
								<div class="row">
									<div class="col-9" style="background-color: #f1f1f1 !important; border:solid 1px #3550a0;">
										<h3>Basic Tools (<i>free</i>)</h3>

										<div class="container" style="max-width: 100%;">
										  <div class="row">
										    <div class="col">
										      <h5>Out of Stock Notice</h5>
										      <p>Add a notice when a product with stock management is out of stock, you can use this to put pressure on customers and show them that your products actually sell. Works great when you show low stock quantities.</p>
										    </div>
										    <div class="col">
										      <h5>Display Discount Percentage</h5>
										      <p>Display the % of price reduction of an item. For items with variants, show the max percentage inside the item. We had good results using this instead of the 'On Sale' badge, as numbers draws more attention.</p>
										    </div>
										    <div class="col">
										      <h5>Removes the <i>On Sale</i> Badge</h5>
										      <p>Removes the 'on sale' badge on discounted items. You can use this in combination with <i>Display Discount Percentage</i> to tell your customers the product is on sale and by how much is the discount.</p>
										    </div>
										    <div class="col">
										      <h5>Price Shortcode by ID</h5>
										      <p>Allow you to use WooCommerce shortcode to show the item price, looking it up by item ID. It may sound something really trivial, but we had quite a few requests for this from our e-commerce customers.</p>
										    </div>					    
										  </div>
										</div>		

										<h3>Pro Tools (<i>paid</i>) <?php 
            
            if ( stw_fs()->is_plan( 'Free', true ) ) {
                ?>
												<?php 
                echo  stwc_settings::UPGRADE_HTML ;
                ?>
											<?php 
            }
            
            ?></h3>						

										<div class="container" style="max-width: 100%;">
										  <div class="row">
										    <div class="col">
										      <h5>Add Custom Column</h5>
										      <p>Add one custom column on your backend (we will be extending this, <a href="<?php 
            echo  stwc_settings::STWC_SUPPORT_URL ;
            ?>" target="_blank">check the roadmap</a> in discord channel), that will show a specific product taxonomy. You can use this to show any data that is important to you.</p>
										    </div>
										    <div class="col">
										      <h5>Skip Cart Page (<i>Buy Now</i>)</h5>
										      <p>Turn your store in a superfast converting machine. Skip the cart page and deliver the customer to the payment page whenever he adds and item to the cart. Useful when customers usually buy only one item.<p>
										    </div>
										    <div class="col">
										      <h5>Send Email on Cancelled Orders</h5>
										      <p>Send the customer an email whenever the order is cancelled or failed. You can customize the WooCommerce email templates for further customization.</p>
										    </div>			    
										  </div>

										  <div class="row" style="padding-top:10px;">
										    <div class="col">
										      <h5>Add GDPR Compliant Checkbox</h5>
										      <p>Show a <u>really GDPR-compliant</u> checkbox on payment page, just after the terms & conditions. This is an evergreen request for customers located in the EU, as you may guess.</p>
										    </div>
										    <div class="col">
										      <h5>Auto Membership</h5>
										      <p>Set a user role upon specific item purchase (<a href="<?php 
            echo  stwc_settings::STWC_SUPPORT_URL ;
            ?>" target="_blank">check the roadmap</a> about how we plan to extend it). For a specific product, it will change the role from 'customer' to the role that you set.</p>
										    </div>
										    <div class="col">
										      <h5>Add P.IVA / VAT to Billing</h5>
										      <p>Add one (yes, we will be <a href="<?php 
            echo  stwc_settings::STWC_SUPPORT_URL ;
            ?>" target="_blank">extending this</a> too :) extra field to your customer billing details, confirmation email and in your backend. Usually VAT number is a really popular request.</p>
										    </div>			    
										  </div>					  
										</div>																
									</div>

								    <div class="col-3">
								    	<div class="container" style="max-width: 100%;">
								    		<div class="row">
								    			<div class="col-6" style="text-align:right;border-right: solid 1px #1d1d1d;">
								      				<p><strong>Author:</strong></p>			      							      							      				      			
								      			</div>

								    			<div class="col-6" style="text-align:left;">
								    				<p><a href="https://www.linkedin.com/in/stefanogandolfo/" target ="_blank">Stefano W. Gandolfo</a></p>      
								      			</div>
								      		</div>		

								      		<!--
								      		<div class="row">
								      			<div class="col-6" style="text-align:right;border-right: solid 1px #1d1d1d;">
								      				<p><strong>Website:</strong></p>
								      			</div>
								      			<div class="col-6" style="text-align:left;">
								      				<p><a href="https://stwc.syncly.it" target ="_blank">https://stwc.syncly.it</a></p>
								      			</div>
								      		</div>	
											-->

								      		<div class="row">
								      			<div class="col-6" style="text-align:right;border-right: solid 1px #1d1d1d;">
								      				<p><strong>Support:</strong></p>
								      			</div>
								      			<div class="col-6" style="text-align:left;">
								      				<p><a href="<?php 
            echo  stwc_settings::STWC_SUPPORT_URL ;
            ?>" target="_blank">Discord Channel</a></p>
								      			</div>
								      		</div>			
								      		
								      		<div class="row">
								      			<div class="col-6" style="text-align:right;border-right: solid 1px #1d1d1d;">
								      				<p><strong>Translators:</strong></p>
								      			</div>
								      			<div class="col-6" style="text-align:left;">
								      				<p><i>We are looking for translators, please find the details on our Discord Channel if you can help.</i></p>
								      			</div>
								      		</div>			

								      		<div class="row">
								      			<div class="col-6" style="text-align:right;border-right: solid 1px #1d1d1d;">
								      				<p><strong>Contributors:</strong></p>
								      			</div>
								      			<div class="col-6" style="text-align:left;">
								      				<p><i>We are looking also for contributors that could suggest new features and see them realized at lightfast speed.</i></p>
								      			</div>
								      		</div>						      					      			      		      		
										</div>			     
								    </div>
								</div>
							</div>
						<?php 
        }
        
        ?>
					</div>
				</div>
			</div>
		</div>

		<?php 
    }
    
    public function create_deal_page()
    {
        ?>				
		<link href="<?php 
        echo  STWC_URL ;
        ?>/admin/css/style.css" rel="stylesheet" type="text/css">
		<link href="<?php 
        echo  STWC_URL ;
        ?>/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<div class="wrap">
	    	<div class="container" style="max-width: 100%;">
	    		<div class="row">
	    			<div class="col-12">
						<h2><strong style="color: #FCB214;margin-bottom:20px;">Upgrade Deal</strong></h2>				    				
						<p style="font-size:16px;padding-bottom:10px;">You, better than anyone, know that everyone loves coupon codes. Here is the current Upgrade Deal for you:<br/>
						Simply join our <a href="<?php 
        echo  stwc_settings::STWC_SUPPORT_URL ;
        ?>" target="_blank">Discord Channel</a> and you will instantly receive a <strong>-10% coupon</strong> valid on all plans.</p>
						
						<a href="<?php 
        echo  stwc_settings::STWC_SUPPORT_URL ;
        ?>" role="button" target="_blank"><img src="<?php 
        echo  STWC_URL ;
        ?>/admin/images/discord-deal.png" alt="Discord Upgrade Deal" style="width:650px;max-width:650px;"></a>
					</div>
	      		</div>
	      	</div>
		</div>
	<?php 
    }
    
    public function create_bulk_page()
    {
        ?>				
		<link href="<?php 
        echo  STWC_URL ;
        ?>/admin/css/style.css" rel="stylesheet" type="text/css">
		<link href="<?php 
        echo  STWC_URL ;
        ?>/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<div class="wrap">
	    	<div class="container" style="max-width: 100%;">
	    		<div class="row">
	    			<div class="col-9">
						<h2 style="color: rgb(0, 171, 240);margin-bottom:20px;">Bulk Coupons</h2>				    				
						<p style="font-size:16px;padding-bottom:10px;">Bulk Coupons is an upcoming feature that will allow you to generate <b>thousands</b> of <u>"easy to remember but hard to guess"</u> codes and WooCommerce coupons. I often use this feature for my customers to easily generate codes for <a href="http://fbuy.me/v/elnath78">AppSumo launch</a> and other purposes where you need a lot of codes.</p>
						<p>At the moment there is no ETA for when this will be available, however you are welcome to <a href="<?php 
        echo  stwc_settings::STWC_SUPPORT_URL ;
        ?>" target="_blank">up vote it in the roadmap</a> to speed this up.</p><br/>
						<p style="font-weight: bold;text-decoration: underline;">What we know so far:</p>		
						<ol>
							<li>There will be one additional <span style="color:#be132d;">Account Tier</span></li>
							<li>Pro users will <u>have access</u> to this functionality</li>
							<li>The functionality will be metered per year</li>
							<li>Lifetime users will have metered reset every year</li>
							<li>Pro users will receive this functionality before</li>
							<li>Generate up to 25.000 codes / year with <span style="color:#be132d;">Tier 3</span> license</li>
						</ol>				
					</div>
	      		</div>
	      	</div>
		</div>
	<?php 
    }
    
    public function settings_page_init()
    {
        register_setting(
            'stwc-default',
            // option_group
            'stwc-settings',
            // option_name
            array( $this, 'settings_sanitize' )
        );
        add_settings_section(
            'stwc_ft_saba_section',
            // id
            'Removes On Sale Badge',
            // title
            array( $this, 'stwc_ft_saba_section_info' ),
            // callback
            'stwc-shop'
        );
        add_settings_section(
            'stwc_ft_oosn_section',
            // id
            'Out of Stock Notice',
            // title
            array( $this, 'stwc_ft_oosn_section_info' ),
            // callback
            'stwc-shop'
        );
        add_settings_section(
            'stwc_ft_dipe_section',
            // id
            'Display Discount Percentage',
            // title
            array( $this, 'stwc_ft_dipe_section_info' ),
            // callback
            'stwc-shop'
        );
        add_settings_section(
            'stwc_ft_prsc_section',
            // id
            'Price Shortcode by ID',
            // title
            array( $this, 'stwc_ft_prsc_section_info' ),
            // callback
            'stwc-general'
        );
        // PAID FEATURES STARTS HERE
        $append = '';
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            $append = stwc_settings::UPGRADE_HTML;
        }
        add_settings_section(
            'stwc_ft_emca_section',
            // id
            'Send Email on Cancelled Orders' . $append,
            // title
            array( $this, 'stwc_ft_emca_section_info' ),
            // callback
            'stwc-automation'
        );
        add_settings_section(
            'stwc_ft_csco_section',
            // id
            'Add Custom Column' . $append,
            // title
            array( $this, 'stwc_ft_csco_section_info' ),
            // callback
            'stwc-general'
        );
        add_settings_section(
            'stwc_ft_usro_section',
            // id
            'Set Role upon specific purchase' . $append,
            // title
            array( $this, 'stwc_ft_usro_section_info' ),
            // callback
            'stwc-automation'
        );
        add_settings_section(
            'stwc_ft_capa_section',
            // id
            'Skip Cart Page => Buy Now' . $append,
            // title
            array( $this, 'stwc_ft_capa_section_info' ),
            // callback
            'stwc-shop'
        );
        add_settings_section(
            'stwc_ft_gdpr_section',
            // id
            'Add GDPR Compliant Checkbox' . $append,
            // title
            array( $this, 'stwc_ft_gdpr_section_info' ),
            // callback
            'stwc-payment'
        );
        add_settings_section(
            'stwc_ft_piva_section',
            // id
            'Add P.IVA / VAT to Billing' . $append,
            // title
            array( $this, 'stwc_ft_piva_section_info' ),
            // callback
            'stwc-payment'
        );
        // END OF PAID FEATURES
        // FIELDS SECTION
        add_settings_field(
            'stwc_ft_oosn_0',
            // id
            'Enable<br><span style="font-size:80%;">(<i>Add CSS to stwc-oosn class</i>)</span>',
            // title
            array( $this, 'stwc_ft_oosn_0_callback' ),
            // callback
            'stwc-shop',
            // page
            'stwc_ft_oosn_section'
        );
        add_settings_field(
            'stwc_ft_oosn_notice_1',
            // id
            'Text to show<br><span style="font-size:80%;">(<i>Example: Sold Out!</i>)</span>',
            // title
            array( $this, 'stwc_ft_oosn_notice_1_callback' ),
            // callback
            'stwc-shop',
            // page
            'stwc_ft_oosn_section'
        );
        add_settings_field(
            'stwc_ft_dipe_7',
            // id
            'Enable<br><span style="font-size:80%;">(<i>Add CSS to stwc-sale-perc class</i>)</span>',
            // title
            array( $this, 'stwc_ft_dipe_7_callback' ),
            // callback
            'stwc-shop',
            // page
            'stwc_ft_dipe_section'
        );
        add_settings_field(
            'stwc_ft_saba_8',
            // id
            'Enable',
            // title
            array( $this, 'stwc_ft_saba_8_callback' ),
            // callback
            'stwc-shop',
            // page
            'stwc_ft_saba_section'
        );
        add_settings_field(
            'stwc_ft_prsc_2',
            // id
            'Enable',
            // title
            array( $this, 'stwc_ft_prsc_2_callback' ),
            // callback
            'stwc-general',
            // page
            'stwc_ft_prsc_section'
        );
        // PAID FEATURES STARTS HERE
        add_settings_field(
            'stwc_ft_csco_3',
            // id
            'Enable',
            // title
            array( $this, 'stwc_ft_csco_3_callback' ),
            // callback
            'stwc-general',
            // page
            'stwc_ft_csco_section'
        );
        add_settings_field(
            'stwc_ft_csco_size_4',
            // id
            'Column Width<br><span style="font-size:80%;">(<i>Start with 15</i>)</span>',
            // title
            array( $this, 'stwc_ft_csco_size_4_callback' ),
            // callback
            'stwc-general',
            // page
            'stwc_ft_csco_section'
        );
        add_settings_field(
            'stwc_ft_csco_name_5',
            // id
            'Column Name<br><span style="font-size:80%;">(<i>Example: Stock</i>)</span>',
            // title
            array( $this, 'stwc_ft_csco_name_5_callback' ),
            // callback
            'stwc-general',
            // page
            'stwc_ft_csco_section'
        );
        add_settings_field(
            'stwc_ft_csco_attribute_name_6',
            // id
            'Product Taxonomy<br><span style="font-size:80%;">(<i>do not include the <code>pa_</code> prefix)</span>',
            // title
            array( $this, 'stwc_ft_csco_attribute_name_6_callback' ),
            // callback
            'stwc-general',
            // page
            'stwc_ft_csco_section'
        );
        add_settings_field(
            'stwc_ft_capa_9',
            // id
            'Enable',
            // title
            array( $this, 'stwc_ft_capa_9_callback' ),
            // callback
            'stwc-shop',
            // page
            'stwc_ft_capa_section'
        );
        add_settings_field(
            'stwc_ft_emca_10',
            // id
            'Enable',
            // title
            array( $this, 'stwc_ft_emca_10_callback' ),
            // callback
            'stwc-automation',
            // page
            'stwc_ft_emca_section'
        );
        add_settings_field(
            'stwc_ft_gdpr_11',
            // id
            'Enable',
            // title
            array( $this, 'stwc_ft_gdpr_11_callback' ),
            // callback
            'stwc-payment',
            // page
            'stwc_ft_gdpr_section'
        );
        add_settings_field(
            'stwc_ft_gdpr_text_12',
            // id
            'GDPR Text<br><span style="font-size:80%;">(<i>Example: "By submitting the order I declare that I have read and accepted your"</i>)</span>',
            // title
            array( $this, 'stwc_ft_gdpr_text_12_callback' ),
            // callback
            'stwc-payment',
            // page
            'stwc_ft_gdpr_section'
        );
        add_settings_field(
            'stwc_ft_gdpr_link_text_13',
            // id
            'GDPR Link Text<br><span style="font-size:80%;">(<i>Example: "privacy policy"</i>)</span>',
            // title
            array( $this, 'stwc_ft_gdpr_link_text_13_callback' ),
            // callback
            'stwc-payment',
            // page
            'stwc_ft_gdpr_section'
        );
        add_settings_field(
            'stwc_ft_gdpr_privacy_page_14',
            // id
            'Privacy Policy URL',
            // title
            array( $this, 'stwc_ft_gdpr_privacy_page_14_callback' ),
            // callback
            'stwc-payment',
            // page
            'stwc_ft_gdpr_section'
        );
        add_settings_field(
            'stwc_ft_usro_15',
            // id
            'Enable',
            // title
            array( $this, 'stwc_ft_usro_15_callback' ),
            // callback
            'stwc-automation',
            // page
            'stwc_ft_usro_section'
        );
        add_settings_field(
            'stwc_ft_usro_product_id_16',
            // id
            'Product ID<br><span style="font-size:80%;">(<i>Membership Virtual Item ID</i>)</span>',
            // title
            array( $this, 'stwc_ft_usro_product_id_16_callback' ),
            // callback
            'stwc-automation',
            // page
            'stwc_ft_usro_section'
        );
        add_settings_field(
            'stwc_ft_usro_role_17',
            // id
            'Role to Assign <br><span style="font-size:80%;">(<i>Name of the role to assign</i>)</span>',
            // title
            array( $this, 'stwc_ft_usro_role_17_callback' ),
            // callback
            'stwc-automation',
            // page
            'stwc_ft_usro_section'
        );
        add_settings_field(
            'stwc_ft_piva_18',
            // id
            'Enable<br><span style="font-size:80%;">(<i>Add P.IVA / VAT field in Billing</i>)</span>',
            // title
            array( $this, 'stwc_ft_piva_18_callback' ),
            // callback
            'stwc-payment',
            // page
            'stwc_ft_piva_section'
        );
        add_settings_field(
            'stwc_ft_piva_label_19',
            // id
            'Label of the Field <br><span style="font-size:80%;">(<i>Shown on the left</i>)</span>',
            // title
            array( $this, 'stwc_ft_piva_label_19_callback' ),
            // callback
            'stwc-payment',
            // page
            'stwc_ft_piva_section'
        );
        add_settings_field(
            'stwc_ft_piva_placeholder_20',
            // id
            'Placeholder <br><span style="font-size:80%;">(<i>Shown inside the field</i>)</span>',
            // title
            array( $this, 'stwc_ft_piva_placeholder_20_callback' ),
            // callback
            'stwc-payment',
            // page
            'stwc_ft_piva_section'
        );
        // END OF PAID FEATURES
    }
    
    public function settings_sanitize( $input )
    {
        $sanitary_values = array();
        //Out of Stock Notice
        if ( isset( $input['stwc_ft_oosn_0'] ) ) {
            $sanitary_values['stwc_ft_oosn_0'] = $input['stwc_ft_oosn_0'];
        }
        if ( isset( $input['stwc_ft_oosn_notice_1'] ) ) {
            $sanitary_values['stwc_ft_oosn_notice_1'] = sanitize_text_field( $input['stwc_ft_oosn_notice_1'] );
        }
        //--validation
        
        if ( isset( $input['stwc_ft_oosn_0'] ) && empty($sanitary_values['stwc_ft_oosn_notice_1']) ) {
            //if (empty($sanitary_values['stwc_ft_oosn_notice_1'])){
            add_settings_error( 'stwc-validate', 'invalid_stwc_ft_oosn_notice_1', 'Out of Stock Notice: [Text to Show] cannot be empty' );
            return false;
            //}
        }
        
        // End Out of Stock
        if ( isset( $input['stwc_ft_dipe_7'] ) ) {
            $sanitary_values['stwc_ft_dipe_7'] = $input['stwc_ft_dipe_7'];
        }
        if ( isset( $input['stwc_ft_saba_8'] ) ) {
            $sanitary_values['stwc_ft_saba_8'] = $input['stwc_ft_saba_8'];
        }
        if ( isset( $input['stwc_ft_capa_9'] ) ) {
            $sanitary_values['stwc_ft_capa_9'] = $input['stwc_ft_capa_9'];
        }
        if ( isset( $input['stwc_ft_prsc_2'] ) ) {
            $sanitary_values['stwc_ft_prsc_2'] = $input['stwc_ft_prsc_2'];
        }
        //if (stw_fs()->is_plan__premium_only('Pro', false)){
        //Add Custom Column
        if ( isset( $input['stwc_ft_csco_3'] ) ) {
            $sanitary_values['stwc_ft_csco_3'] = $input['stwc_ft_csco_3'];
        }
        if ( isset( $input['stwc_ft_csco_size_4'] ) ) {
            $sanitary_values['stwc_ft_csco_size_4'] = sanitize_text_field( $input['stwc_ft_csco_size_4'] );
        }
        if ( isset( $input['stwc_ft_csco_name_5'] ) ) {
            $sanitary_values['stwc_ft_csco_name_5'] = sanitize_text_field( $input['stwc_ft_csco_name_5'] );
        }
        if ( isset( $input['stwc_ft_csco_attribute_name_6'] ) ) {
            $sanitary_values['stwc_ft_csco_attribute_name_6'] = sanitize_text_field( $input['stwc_ft_csco_attribute_name_6'] );
        }
        //--validation
        
        if ( isset( $input['stwc_ft_csco_3'] ) ) {
            
            if ( isset( $input['stwc_ft_csco_size_4'] ) && !ctype_digit( $sanitary_values['stwc_ft_csco_size_4'] ) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_csco_size_4', 'Add Custom Column: [Column Width] must be a number' );
                return false;
            }
            
            
            if ( empty($sanitary_values['stwc_ft_csco_name_5']) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_csco_name_5', 'Add Custom Column: [Column Name] cannot be empty' );
                return false;
            }
            
            
            if ( empty($sanitary_values['stwc_ft_csco_attribute_name_6']) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_csco_attribute_name_6', 'Add Custom Column: [Product Taxonomy] cannot be empty' );
                return false;
            } else {
                
                if ( !taxonomy_exists( 'pa_' . $sanitary_values['stwc_ft_csco_attribute_name_6'] ) ) {
                    add_settings_error( 'stwc-validate', 'invalid_stwc_ft_csco_attribute_name_6', 'Add Custom Column: [Product Taxonomy] doesn\'t exist' );
                    return false;
                }
            
            }
        
        }
        
        // End Custom Column
        if ( isset( $input['stwc_ft_emca_10'] ) ) {
            $sanitary_values['stwc_ft_emca_10'] = $input['stwc_ft_emca_10'];
        }
        // Add GDPR Compliant Checkbox
        if ( isset( $input['stwc_ft_gdpr_11'] ) ) {
            $sanitary_values['stwc_ft_gdpr_11'] = $input['stwc_ft_gdpr_11'];
        }
        if ( isset( $input['stwc_ft_gdpr_text_12'] ) ) {
            $sanitary_values['stwc_ft_gdpr_text_12'] = sanitize_text_field( $input['stwc_ft_gdpr_text_12'] );
        }
        if ( isset( $input['stwc_ft_gdpr_link_text_13'] ) ) {
            $sanitary_values['stwc_ft_gdpr_link_text_13'] = sanitize_text_field( $input['stwc_ft_gdpr_link_text_13'] );
        }
        if ( isset( $input['stwc_ft_gdpr_privacy_page_14'] ) ) {
            $sanitary_values['stwc_ft_gdpr_privacy_page_14'] = sanitize_text_field( $input['stwc_ft_gdpr_privacy_page_14'] );
        }
        //--validation
        
        if ( isset( $input['stwc_ft_gdpr_11'] ) ) {
            
            if ( empty($sanitary_values['stwc_ft_gdpr_text_12']) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_gdpr_text_12', 'Add GDPR Compliant Checkbox: [GDPR Text] cannot be empty' );
                return false;
            }
            
            
            if ( empty($sanitary_values['stwc_ft_gdpr_link_text_13']) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_gdpr_link_text_13', 'Add GDPR Compliant Checkbox: [GDPR Link Text] cannot be empty' );
                return false;
            }
            
            
            if ( empty($sanitary_values['stwc_ft_gdpr_privacy_page_14']) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_gdpr_privacy_page_14', 'Add GDPR Compliant Checkbox: [Privacy Policy URL] cannot be empty' );
                return false;
            }
        
        }
        
        // End GDPR Checkbox
        //Set Role upon specific purchase
        if ( isset( $input['stwc_ft_usro_15'] ) ) {
            $sanitary_values['stwc_ft_usro_15'] = $input['stwc_ft_usro_15'];
        }
        if ( isset( $input['stwc_ft_usro_product_id_16'] ) ) {
            $sanitary_values['stwc_ft_usro_product_id_16'] = sanitize_text_field( $input['stwc_ft_usro_product_id_16'] );
        }
        if ( isset( $input['stwc_ft_usro_role_17'] ) ) {
            $sanitary_values['stwc_ft_usro_role_17'] = sanitize_text_field( $input['stwc_ft_usro_role_17'] );
        }
        //--validation
        
        if ( isset( $input['stwc_ft_usro_15'] ) ) {
            
            if ( isset( $input['stwc_ft_usro_product_id_16'] ) && !ctype_digit( $sanitary_values['stwc_ft_usro_product_id_16'] ) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_usro_product_id_16', 'Set Role upon specific purchase: [Product ID] must be a number' );
                return false;
            } else {
                try {
                    $_product = new WC_Product( $sanitary_values['stwc_ft_usro_product_id_16'] );
                } catch ( Exception $e ) {
                    add_settings_error( 'stwc-validate', 'invalid_stwc_ft_usro_product_id_16', 'Set Role upon specific purchase: [Product ID] doesn\'t exist' );
                    return false;
                }
            }
            
            
            if ( empty($input['stwc_ft_usro_role_17']) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_usro_role_17', 'Set Role upon specific purchase: [Role to Assign ] cannot be empty' );
                return false;
            } else {
                
                if ( is_null( get_role( $sanitary_values['stwc_ft_usro_role_17'] ) ) ) {
                    add_settings_error( 'stwc-validate', 'invalid_stwc_ft_usro_role_17', 'Set Role upon specific purchase: [Role to Assign ] doesn\'t exist' );
                    return false;
                }
            
            }
        
        }
        
        //
        // Add P.IVA / VAT to Billing
        if ( isset( $input['stwc_ft_piva_18'] ) ) {
            $sanitary_values['stwc_ft_piva_18'] = $input['stwc_ft_piva_18'];
        }
        if ( isset( $input['stwc_ft_piva_label_19'] ) ) {
            $sanitary_values['stwc_ft_piva_label_19'] = sanitize_text_field( $input['stwc_ft_piva_label_19'] );
        }
        if ( isset( $input['stwc_ft_piva_placeholder_20'] ) ) {
            $sanitary_values['stwc_ft_piva_placeholder_20'] = sanitize_text_field( $input['stwc_ft_piva_placeholder_20'] );
        }
        //--validation
        
        if ( isset( $input['stwc_ft_piva_18'] ) ) {
            
            if ( empty($sanitary_values['stwc_ft_piva_label_19']) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_piva_label_19', 'Add P.IVA / VAT to Billing: [Label of the Field] cannot be empty' );
                return false;
            }
            
            
            if ( empty($sanitary_values['stwc_ft_piva_placeholder_20']) ) {
                add_settings_error( 'stwc-validate', 'invalid_stwc_ft_piva_placeholder_20', 'Add P.IVA / VAT to Billing: [Placeholder ] cannot be empty' );
                return false;
            }
        
        }
        
        //
        //}
        return $sanitary_values;
    }
    
    public function stwc_ft_oosn_section_info()
    {
        echo  "<p style='font-size: 16px;'>When a product with stock management is out of stock (quantity 0) WooCommerce doesn't show any notice in the shop page. In some cases, it is convenient to tell the customers that \r\n\t\ta product is out of stock, depending on your business logic. If you enable this option you can show a custom message, make sure to use CSS to style it appropriately.</p>" ;
    }
    
    public function stwc_ft_dipe_section_info()
    {
        echo  "<p style='font-size: 16px;'>Display the % of price reduction of an item. For items with variants, show the max percentage inside the item. You can copy this <span class='stwc-sale-perc'>CSS</span> for example.</p>" ;
    }
    
    public function stwc_ft_saba_section_info()
    {
        echo  "<p style='font-size: 16px;'>Removes the 'on sale' badge on discounted items. You can use this in combination with <i>Display Discount Percentage</i> to tell your customers the product is on sale and by how much is the discount.</p>" ;
    }
    
    public function stwc_ft_prsc_section_info()
    {
        echo  "<p style='font-size: 16px;'>Allow you to use WooCommerce shortcode to show the item price, looking it up by item ID.</p>" ;
    }
    
    // PAID FEATURES STARTS HERE
    public function stwc_ft_csco_section_info()
    {
        echo  "<p style='font-size: 16px;'>Add one custom column on your backend, that will show a specific product taxonomy. You can use this to show any data that is important to you, the column will be added on the right side of the SKU column.</p>" ;
    }
    
    public function stwc_ft_capa_section_info()
    {
        echo  "<p style='font-size: 16px;'>Turn your store in a superfast converting machine. Skip the cart page and deliver the customer to the payment page whenever he adds and item to the cart. Use this on websites where customers usually buy only one item at a time.</p>\r\n\t\t\t\t      <strong><u>Before do the following</u></strong>:<br>\r\n\t\t\t\t      <ol>\r\n\t\t\t\t      \t<li>Visit WooCommerce > Settings > Products > General (or <a href='admin.php?page=wc-settings&tab=products' target='_blank'>click here</a> to open WC settings in a new tab)</li>\r\n\t\t\t\t      \t<li>Remove both 'Add to cart behaviour' checkboxes</li>\r\n\t\t\t\t      </ol>\r\n\t" ;
    }
    
    public function stwc_ft_emca_section_info()
    {
        echo  "<p style='font-size: 16px;'>Send the customer an email whenever the order is cancelled or failed. You can customize the WooCommerce email templates for further customization.</p>" ;
    }
    
    public function stwc_ft_gdpr_section_info()
    {
        echo  "<p style='font-size: 16px;'>Show a <u>really compliant checkbox</u> on payment page, just after the terms &amp; conditions. Remember to add some styling, example: <code>.woocommerce-invalid #chk_privacy {outline: 2px solid red;outline-offset: 2px;}</code></p>" ;
    }
    
    public function stwc_ft_usro_section_info()
    {
        echo  "<p style='font-size: 16px;'>Use this to create a Membership site! For a specific product, it will change the role from 'customer' to the role that you set. To make this work, the orders containing the specified product ID will also be automatically completed.</p>\r\n\t\t\t\t      <strong><u>Before do the following</u></strong>:<br>\r\n\t\t\t\t      <ol>\r\n\t\t\t\t      \t<li>1) Visit WooCommerce > Settings > Account &amp; Privacy (or <a href='admin.php?page=wc-settings&tab=account' target='_blank'>click here</a> to open WC settings in a new tab)</li>\r\n\t\t\t\t      \t<li>Disable Guest Checkout and enable Account Creation</li>\r\n\t\t\t\t      </ol>\r\n\t" ;
    }
    
    public function stwc_ft_piva_section_info()
    {
        echo  "<p style='font-size: 16px;'>Add one extra field to your customer billing details, confirmation email and in your backend. The VAT number (P.IVA) is in high demand, but you can use this extra field. For this purpose, it is not performed any validation.</p>" ;
    }
    
    // END OF PAID FEATURES
    public function stwc_ft_oosn_0_callback()
    {
        printf( '<input type="checkbox" name="stwc-settings[stwc_ft_oosn_0]" id="stwc_ft_oosn_0" value="stwc_ft_oosn_0" %s> <label for="stwc_ft_oosn_0">Enable Out of Stock notice on Out-of-Stock items that have Stock Management</label>', ( isset( $this->settings_options['stwc_ft_oosn_0'] ) && $this->settings_options['stwc_ft_oosn_0'] === 'stwc_ft_oosn_0' ? 'checked' : '' ) );
    }
    
    public function stwc_ft_oosn_notice_1_callback()
    {
        printf( '<input class="regular-text" type="text" name="stwc-settings[stwc_ft_oosn_notice_1]" id="stwc_ft_oosn_notice_1" value="%s">', ( isset( $this->settings_options['stwc_ft_oosn_notice_1'] ) ? esc_attr( $this->settings_options['stwc_ft_oosn_notice_1'] ) : '' ) );
    }
    
    public function stwc_ft_dipe_7_callback()
    {
        printf( '<input type="checkbox" name="stwc-settings[stwc_ft_dipe_7]" id="stwc_ft_dipe_7" value="stwc_ft_dipe_7" %s> <label for="stwc_ft_dipe_7">Display Discount Percentage</label>', ( isset( $this->settings_options['stwc_ft_dipe_7'] ) && $this->settings_options['stwc_ft_dipe_7'] === 'stwc_ft_dipe_7' ? 'checked' : '' ) );
    }
    
    public function stwc_ft_saba_8_callback()
    {
        printf( '<input type="checkbox" name="stwc-settings[stwc_ft_saba_8]" id="stwc_ft_saba_8" value="stwc_ft_saba_8" %s> <label for="stwc_ft_saba_8">Removes On Sale Badge</label>', ( isset( $this->settings_options['stwc_ft_saba_8'] ) && $this->settings_options['stwc_ft_saba_8'] === 'stwc_ft_saba_8' ? 'checked' : '' ) );
    }
    
    public function stwc_ft_prsc_2_callback()
    {
        printf( '<input type="checkbox" name="stwc-settings[stwc_ft_prsc_2]" id="stwc_ft_prsc_2" value="stwc_ft_prsc_2" %s> <label for="stwc_ft_prsc_2">Enable Price Shortcode by Item ID</label>', ( isset( $this->settings_options['stwc_ft_prsc_2'] ) && $this->settings_options['stwc_ft_prsc_2'] === 'stwc_ft_prsc_2' ? 'checked' : '' ) );
    }
    
    // PAID FEATURES STARTS HERE
    public function stwc_ft_csco_3_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input type="checkbox" name="stwc_ft_csco_3" id="stwc_ft_csco_3" value="" disabled> <label for="stwc_ft_csco_3" class="ctr_disabled">Add Custom Column</label>' ;
        }
    }
    
    public function stwc_ft_csco_size_4_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_csco_size_4" id="stwc_ft_csco_size_4" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_csco_name_5_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_csco_name_5" id="stwc_ft_csco_name_5" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_csco_attribute_name_6_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_csco_attribute_name_6" id="stwc_ft_csco_attribute_name_6" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_capa_9_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input type="checkbox" name="stwc_ft_capa_9" id="stwc_ft_capa_9" value="" disabled> <label for="stwc_ft_capa_9" class="ctr_disabled">Skip Cart Page => Buy Now</label>' ;
        }
    }
    
    public function stwc_ft_emca_10_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input type="checkbox" name="stwc_ft_emca_10" id="stwc_ft_emca_10" value="" disabled> <label for="stwc_ft_emca_10" class="ctr_disabled">Send Email on Cancelled Orders</label>' ;
        }
    }
    
    public function stwc_ft_gdpr_11_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input type="checkbox" name="stwc_ft_gdpr_11" id="stwc_ft_gdpr_11" value="" disabled> <label for="stwc_ft_gdpr_11" class="ctr_disabled">Add GDPR Compliant Checkbox</label>' ;
        }
    }
    
    public function stwc_ft_gdpr_text_12_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_gdpr_text_12" id="stwc_ft_gdpr_text_12" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_gdpr_link_text_13_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_gdpr_link_text_13" id="stwc_ft_gdpr_link_text_13" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_gdpr_privacy_page_14_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_gdpr_privacy_page_14" id="stwc_ft_gdpr_privacy_page_14" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_usro_15_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input type="checkbox" name="stwc_ft_usro_15" id="stwc_ft_usro_15" value="" disabled> <label for="stwc_ft_usro_15" class="ctr_disabled">Add GDPR Compliant Checkbox</label>' ;
        }
    }
    
    public function stwc_ft_usro_product_id_16_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_usro_product_id_16" id="stwc_ft_usro_product_id_16" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_usro_role_17_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_usro_role_17" id="stwc_ft_usro_role_17" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_piva_18_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input type="checkbox" name="stwc_ft_piva_18" id="stwc_ft_piva_18" value="" disabled> <label for="stwc_ft_piva_18" class="ctr_disabled">Add GDPR Compliant Checkbox</label>' ;
        }
    }
    
    public function stwc_ft_piva_label_19_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_piva_label_19" id="stwc_ft_piva_label_19" value="" disabled>' ;
        }
    }
    
    public function stwc_ft_piva_placeholder_20_callback()
    {
        if ( stw_fs()->is_plan( 'Free', true ) ) {
            echo  '<input class="regular-text" type="text" name="stwc_ft_piva_placeholder_20" id="stwc_ft_piva_placeholder_20" value="" disabled>' ;
        }
    }

}