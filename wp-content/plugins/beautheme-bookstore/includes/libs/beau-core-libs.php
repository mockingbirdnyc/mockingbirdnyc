<?php
/**
 * Load Libs
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if( !class_exists( 'MCAPI' ) ) {
    if ( file_exists( BEAU_CORE_PATH.'/includes/libs/MailChimp/MCAPI.class.php' ) ) {
        require_once wp_normalize_path( BEAU_CORE_PATH.'/includes/libs/MailChimp/MCAPI.class.php' );
    }
}
if( !class_exists( 'ReduxFramework' ) ) {
    if ( file_exists( BEAU_CORE_PATH.'/includes/libs/redux/ReduxCore/framework.php' ) ) {
        require_once wp_normalize_path( BEAU_CORE_PATH.'/includes/libs/redux/ReduxCore/framework.php' );
    }
}
if( !function_exists( 'register_field_group' ) ) {
    if (file_exists(BEAU_CORE_PATH. '/includes/libs/advanced-custom-fields/acf.php')) {
        require_once(BEAU_CORE_PATH. '/includes/libs/advanced-custom-fields/acf.php');
    }
}