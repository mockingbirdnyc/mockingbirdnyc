<?php
/**
 * Deprecated Replace
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function bebostore_findExtension($filename){
    return BeauCore()->deprecated->findExtension($filename);
}
function beau_get_attachment_id_from_url($attachment_url = ''){
    return BeauCore()->deprecated->beau_get_attachment_id_from_url($attachment_url);
}
function domain($domainb){
    return BeauCore()->deprecated->domain($domainb);
}
add_filter('acf/settings/remove_wp_meta_box', '__return_false', 20);