<?php

function stwc_settings_sections($page, $split) {
    global $wp_settings_sections, $wp_settings_fields;
    //$page = 'stwc-free';

    if ( ! isset( $wp_settings_sections[ $page ] ) ) {
        return;
    }
 
    $count = 1;
    foreach ( (array) $wp_settings_sections[ $page ] as $section ) {
        if ($count == $split ){
            echo "</div><div class='col-6'>";
        }
        
        if ( $section['title'] ) {
            echo "<h2>{$section['title']}</h2>\n";
        }
 
        if ( $section['callback'] ) {
            call_user_func( $section['callback'], $section );
        }
 
        if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $page ] ) || ! isset( $wp_settings_fields[ $page ][ $section['id'] ] ) ) {
            continue;
        }
        echo '<table class="form-table" role="presentation">';
        do_settings_fields( $page, $section['id'] );
        echo '</table>';

        $count++;
    }
}

/*
function stwc_general_settings_sections() {
    global $wp_settings_sections, $wp_settings_fields;
    $page = 'stwc-free';

    if ( ! isset( $wp_settings_sections[ $page ] ) ) {
        return;
    }
 
    $count = 0;
    foreach ( (array) $wp_settings_sections[ $page ] as $section ) {
        if ($count == 2 ){
            echo "</div><div class='col-6'>";
        }
        
        if ( $section['title'] ) {
            echo "<h2>{$section['title']}</h2>\n";
        }
 
        if ( $section['callback'] ) {
            call_user_func( $section['callback'], $section );
        }
 
        if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $page ] ) || ! isset( $wp_settings_fields[ $page ][ $section['id'] ] ) ) {
            continue;
        }
        echo '<table class="form-table" role="presentation">';
        do_settings_fields( $page, $section['id'] );
        echo '</table>';

        $count++;
    }
}

function stwc_free_settings_sections() {
    global $wp_settings_sections, $wp_settings_fields;
 	$page = 'stwc-free';

    if ( ! isset( $wp_settings_sections[ $page ] ) ) {
        return;
    }
 
 	$count = 0;
    foreach ( (array) $wp_settings_sections[ $page ] as $section ) {
    	if ($count == 2 ){
    		echo "</div><div class='col-6'>";
    	}
    	
        if ( $section['title'] ) {
            echo "<h2>{$section['title']}</h2>\n";
        }
 
        if ( $section['callback'] ) {
            call_user_func( $section['callback'], $section );
        }
 
        if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $page ] ) || ! isset( $wp_settings_fields[ $page ][ $section['id'] ] ) ) {
            continue;
        }
        echo '<table class="form-table" role="presentation">';
        do_settings_fields( $page, $section['id'] );
        echo '</table>';

        $count++;
    }
}

function stwc_prot_settings_sections() {
    if (stw_fs()->is_plan__premium_only('Pro', true)){              
        global $wp_settings_sections, $wp_settings_fields;
     	$page = 'stwc-prot';

        if ( ! isset( $wp_settings_sections[ $page ] ) ) {
            return;
        }
     
     	$count = 0;
        foreach ( (array) $wp_settings_sections[ $page ] as $section ) {
        	if ($count == 3 ){
        		echo "</div><div class='col-6'>";
        	}
        	
            if ( $section['title'] ) {
                echo "<h2>{$section['title']}</h2>\n";
            }
     
            if ( $section['callback'] ) {
                call_user_func( $section['callback'], $section );
            }
     
            if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[ $page ] ) || ! isset( $wp_settings_fields[ $page ][ $section['id'] ] ) ) {
                continue;
            }
            echo '<table class="form-table" role="presentation">';
            do_settings_fields( $page, $section['id'] );
            echo '</table>';

            $count++;
        }
    }
}
*/

?>