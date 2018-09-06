<?php
/**
 * Deprecated
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauCore_Deprecated' ) ) {
    /**
    *
    */
    class BeauCore_Deprecated {




        //Check extension
        public function findExtension ($filename)
        {
            $filename = strtolower($filename) ;
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            // var_dump($ext);
            return $ext;
        }


         //Return Attactment ID
        public function beau_get_attachment_id_from_url( $attachment_url = '' ) {
            global $wpdb;
            $attachment_id = false;
            if ( '' == $attachment_url )
                return;
            $upload_dir_paths = wp_upload_dir();
            if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
                $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
                $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
                $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
            }
            return $attachment_id;
        }

        public function domain($domainb){
            $bits = explode('/', $domainb);
            if ($bits[0]=='http:' || $bits[0]=='https:'){
                $domainb= $bits[2];
             } else {
                $domainb= $bits[0];
             }
            unset($bits);
            $bits = explode('.', $domainb);
            $idz=count($bits);
            $idz-=3;
            if (strlen($bits[($idz+2)])==2) {
                $url=$bits[$idz].'.'.$bits[($idz+1)].'.'.$bits[($idz+2)];
            } else if (strlen($bits[($idz+2)])==0) {
                $url=$bits[($idz)].'.'.$bits[($idz+1)];
            } else {
                $url=$bits[($idz+1)].'.'.$bits[($idz+2)];
            }
            return $url;
        }

    }
}