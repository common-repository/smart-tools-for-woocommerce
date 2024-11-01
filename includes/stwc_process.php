<?php

add_filter( 'woocommerce_sale_flash', 'stwc_oosn' );
function stwc_oosn( $text )
{
    $option = get_option( 'stwc-settings' )['stwc_ft_oosn_0'];
    $notice = sanitize_text_field( get_option( 'stwc-settings' )['stwc_ft_oosn_notice_1'] );
    
    if ( $option ) {
        global  $product ;
        
        if ( $product->managing_stock() && $product->get_stock_quantity() == 0 ) {
            return '<span class="onsale stwc-oosn">' . $notice . '</span>';
        } else {
            return $text;
        }
    
    } else {
        return $text;
    }

}

add_action( 'woocommerce_before_shop_loop_item_title', 'stwc_dipe', 25 );
function stwc_dipe()
{
    $option = get_option( 'stwc-settings' )['stwc_ft_dipe_7'];
    
    if ( $option ) {
        global  $product ;
        if ( !$product->is_on_sale() ) {
            return;
        }
        
        if ( $product->is_type( 'simple' ) ) {
            $max_percentage = ($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price() * 100;
        } elseif ( $product->is_type( 'variable' ) ) {
            $max_percentage = 0;
            foreach ( $product->get_children() as $child_id ) {
                $variation = wc_get_product( $child_id );
                $price = $variation->get_regular_price();
                $sale = $variation->get_sale_price();
                if ( $price != 0 && !empty($sale) ) {
                    $percentage = ($price - $sale) / $price * 100;
                }
                if ( $percentage > $max_percentage ) {
                    $max_percentage = $percentage;
                }
            }
        }
        
        if ( $max_percentage > 0 ) {
            echo  "<div class='stwc-sale-perc'>-" . round( $max_percentage ) . "%</div>" ;
        }
    }

}

add_filter( 'woocommerce_sale_flash', 'stwc_saba' );
function stwc_saba( $text )
{
    $option = get_option( 'stwc-settings' )['stwc_ft_saba_8'];
    
    if ( $option ) {
        return false;
    } else {
        return $text;
    }

}

add_shortcode( 'cl_product_price', 'stwc_prsc' );
function stwc_prsc( $atts )
{
    $option = get_option( 'stwc-settings' )['stwc_ft_prsc_2'];
    
    if ( $option ) {
        $atts = shortcode_atts( array(
            'id' => null,
        ), $atts, 'cl_product_price' );
        if ( empty($atts['id']) ) {
            return '';
        }
        $product = wc_get_product( $atts['id'] );
        if ( !$product ) {
            return '';
        }
        $price = $product->get_price();
        $price = wc_format_decimal( $price, wc_get_price_decimals() );
        //return $product->get_price();
        return $price;
    }

}

stwc_SetFiltersActions();
function stwc_SetFiltersActions()
{
}

function stwc_csco_column( $columns )
{
}

function stwc_csco_values( $column, $postid )
{
}

function stwc_capa_redirect()
{
}

function stwc_capa_text( $text )
{
}

function stwc_emca(
    $order_id,
    $old_status,
    $new_status,
    $order
)
{
}

function stwc_gdpr_checkout()
{
}

function stwc_gdpr_warning()
{
}

function stwc_usro_complete( $order_id )
{
}

function stwc_usro_role( $order_id )
{
}

function stwc_piva_field( $fields )
{
}

function stwc_piva_meta( $order_id )
{
}

function stwc_piva_backend( $order )
{
}

function stwc_piva_email( $keys )
{
}
