<?php

/*
Plugin Name: Advanced-Custom-Fields-Has-Capability
Plugin URI:
Description: Add a new field type called "ETAC Has Capability".  This field is always invisible, but if your current user has a matching capability that you select, then the whole field group will be visible, otherwise, the whole field group will not be presented to the user.  Next steps - some extra eyes on security would be helpful.
Version: 1.0.0
Author: Thiti (shinemonkey212@gmail.com)
Author URI:
History: The development of this was originally funded by JJ Rohrer.
Depends:  Advanced Custom Fields Pro=>http://www.advancedcustomfields.com/
Dependancy Notes: Not tested against the non-pro version of ACF.  It might or might not work.
*/

register_activation_hook( __FILE__, 'ETAC_install' );
register_uninstall_hook( __FILE__, 'ETAC_uninstall' );

function ETAC_install(){
    global $wp_roles;

    if ( class_exists( 'WP_Roles' ) ) {
        if ( ! isset( $wp_roles ) ) {
            $wp_roles = new WP_Roles();
        }
    }

    $wp_roles->add_cap( 'administrator', 'etac_dev' );
}

function ETAC_uninstall(){
    global $wp_roles;

    if ( class_exists( 'WP_Roles' ) ) {
        if ( ! isset( $wp_roles ) ) {
            $wp_roles = new WP_Roles();
        }
    }

    $wp_roles->remove_cap( 'administrator', 'etac_dev' );
}

add_action('acf/include_field_types', 'include_field_types_ETAC_has_capability');
function include_field_types_ETAC_has_capability( $version ) {
	include_once('acf-ETAC_has_capability-v5.php');
}

add_action('acf/register_fields', 'register_fields_ETAC_has_capability');
function register_fields_ETAC_has_capability() {
	include_once('acf-ETAC_has_capability-v4.php');
}
?>