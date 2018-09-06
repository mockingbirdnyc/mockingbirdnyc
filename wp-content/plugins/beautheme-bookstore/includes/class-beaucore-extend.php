<?php
/**
 * Extend
 * @package Beau-Core
 * @subpackage Core
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauCore_Extend' ) ) {
    /**
     * The main class.
     */
    class BeauCore_Extend {
        public function __construct() {
            add_action( 'wp_footer', array($this,'bookstore_action_script' ));
            //Add request data
            add_action('wp_ajax_beau_ApiSubcribe', array($this,'beau_storeAddress'));
            add_action('wp_ajax_nopriv_beau_ApiSubcribe', array($this,'beau_storeAddress'));
            add_action('init', array($this,'flip_back'));
        }
        public function bookstore_action_script(){
        ?>
        <script>
            (function($){
                "use strict";
                // Subcribe mailchimp
                $('#bookstore-subcribe').submit(function() {
                    // update user interface
                    $('.subcribe-message').html('<?php esc_html_e('Adding email address...','bebostore');?>');
                    $.ajax({
                        url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
                        data: 'beautheme_mailchimp_ajax_subcribe=true&email-subcribe=' + escape($('.txt-subcrible-text').val()),
                        success: function(msg) {
                            $('.subcribe-message').html(msg);
                        }
                    });

                    return false;
                });
            })(jQuery)
        </script>
        <?php
        }
        function beau_storeAddress(){
            global $beau_option;
            if (isset($beau_option['mailchimp-api'])) {
                $api_value  = $beau_option['mailchimp-api'];
            }else{
                $api_value  = "";
            }
            if (isset($beau_option['mailchimp-api'])) {
                $list_id    = $beau_option['mailchimp-groupid'];
            }else{
                $list_id ="";
            }

            // Validation
            if(!$_GET['email-subcribe']){ return "No email address provided"; }

            if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_GET['email-subcribe'])) {
                return "Email address is invalid";
                exit();
            }

            // grab an API Key from http://admin.mailchimp.com/account/api/
            $api = new MCAPI($api_value);

            // grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
            // Click the "settings" link for the list - the Unique Id is at the bottom of that page.
            //$list_id = "my_list_unique_id";

            if($api->listSubscribe($list_id, $_GET['email-subcribe'], '') === true) {
                // It worked!
                return esc_html__('Success! Check your email to confirm sign up.','bebostore');
                exit();
            }else{
                // An error ocurred, return error message
                return esc_html__('Error: ','bebostore') . $api->errorMessage;
                exit();
            }
        }
        public function flip_back(){
            if (class_exists('MultiPostThumbnails')) {
                $flip_back = new MultiPostThumbnails(
                    array(
                        'label' => __('Book back image' ,'bebostore'),
                        'id' => 'book-back-image',
                        'post_type' => 'product'
                    )
                );
            }
            return $flip_back;
        }
    }
}