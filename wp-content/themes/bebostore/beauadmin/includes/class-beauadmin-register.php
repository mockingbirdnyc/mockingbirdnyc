<?php
/**
 * BeauAdmin Register
 * @package BeauAdmin
 * @author BeauThemes
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauAdmin_Register' ) ) {
    /**
     * The main class.
     */

    class BeauAdmin_Register {
        public function __construct() {
             add_action( 'wp_ajax_register_add', [$this,'register_add_callback'] );
             add_action( 'wp_ajax_register_deactive', [$this,'register_deactive_callback'] );
        }
        public function form() {
            $get_buyer = get_transient('beauadmin_purchasecode_buyer');
            $get_purchase = get_transient('beauadmin_purchasecode_purchase');
            $get_status = get_transient('beauadmin_purchasecode_status');
            ?>
            <div class="registration-wrap">
                <form method="post" id="registration-form" class="registration-form" <?php if($get_purchase && $get_buyer && ($get_status != 0 ) ): ?> data-type="deactive" <?php endif;?>>
                    <input type="hidden" name="_wpnonce" id="_beau_reg_wpnonce" value="<?php echo wp_create_nonce( 'registration' );?>">
                    <div class="buyer-registration">
                        <span class="dashicons dashicons-admin-users"></span>
                        <input type="text" name="_buyer" id="_beau_reg_buyer" <?php if($get_buyer && ($get_status != 0 )): ?> value="<?php echo esc_attr($get_buyer)?>"  <?php endif; ?> placeholder="<?php esc_attr_e('ThemeForest User ...','beauadmin')?>">
                    </div>
                    <div class="purchase-registration">
                        <span class="dashicons dashicons-tickets-alt"></span>
                        <input type="text" name="_purchase" id="_beau_reg_purchase" <?php if($get_purchase && ($get_status != 0 )): ?> value="<?php echo esc_attr($get_purchase)?>"  <?php endif; ?> placeholder="<?php esc_attr_e('Purchase Code ...','beauadmin')?>">
                    </div>
                    <?php if($get_status != 1): ?>
                        <div class="submit-registration">
                            <?php submit_button(esc_attr__('Active','beauadmin')); ?>
                        </div>
                    <?php endif;?>
                </form>
                <?php if($get_purchase && $get_buyer && ($get_status != 0 )): ?>
                    <form method="post" id="deactive-form" class="deactive-form">
                        <input type="hidden" name="_wpnonce_deactive" id="_beau_deactive_wpnonce" value="<?php echo wp_create_nonce( 'deactive' );?>">
                        <?php submit_button(esc_attr__('Deactive','beauadmin')); ?>
                    </form>
                <?php endif;?>
            </div>
            <?php
        }
        public function register_add_callback() {
            global $wpdb; // this is how you get access to the database
            check_ajax_referer( 'registration', 'security' );
            $buyer = ( $_POST['buyer'] );
            $purchase = ( $_POST['purchase'] );
            if($buyer != '' && $purchase != '') {
                set_transient('beauadmin_purchasecode_buyer',$buyer);
                set_transient('beauadmin_purchasecode_purchase',$purchase);
                set_transient('beauadmin_purchasecode_status',1);
            }
          die();
        }
         public function register_deactive_callback() {
            global $wpdb; // this is how you get access to the database
            check_ajax_referer( 'deactive', 'security' );
            set_transient('beauadmin_purchasecode_status',0);
          die();
        }
    }
}