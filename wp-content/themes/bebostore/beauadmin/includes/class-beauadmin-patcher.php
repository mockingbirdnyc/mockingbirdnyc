<?php
/**
 * BeauAdmin Patcher
 * @package BeauAdmin
 * @author BeauThemes
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauAdmin_Patcher' ) ) {
    /**
     * The main class.
     */

    class BeauAdmin_Patcher {
        /**
         * Instance of the class.
         *
         * @static
         * @access protected
         * @since 1.0.0
         * @var object
         */
        protected static $instance = null;
        /**
         * The root of the remote server where demos are off-loaded.
         *
         * @static
         * @access protected
         * @var string
         */
        protected static $remote_patcher;

        function __construct(){
            $this->patch = [];
            $this->template = get_option('template');
            if($this->template != ''){
                    self::$remote_patcher = 'http://api.beautheme.com/?beau_bpa='.$this->template;
            }
            $this->get_buyer = get_transient('beauadmin_purchasecode_buyer');
            $this->get_purchase = get_transient('beauadmin_purchasecode_purchase');
            $this->get_purchase_status = get_transient('beauadmin_purchasecode_status');
            if(!$this->get_buyer && !$this->get_purchase) {
                return false;
            }
            $this->get_domain = $_SERVER['SERVER_NAME'];
            $this->get_email = wp_get_current_user()->user_email;
            $this->get_arr = [
                'api_buyer'     => $this->get_buyer,
                'api_code'      => $this->get_purchase,
                'api_status'      => $this->get_purchase_status,
                'api_domain'    => $this->get_domain,
                'api_email'     => $this->get_email
            ];
            $this->get_url_key(self::$remote_patcher.'&'.http_build_query($this->get_arr),'beauadmin-patcher');
            $this->set_log();
            add_action( 'wp_ajax_patcher_apply', [$this,'patcher_apply_callback'] );
            $this->get_count_apply();

        }
        /**
         * Gets the demos data from the remote server (or locally if remote is unreachable)
         * decodes the JSON object and returns an array.
         *
         * @static
         * @access public
         * @since 1.0.0
         * @return array
         */
        public static function get_url_key($url,$key) {
            // Get the demo details from the remote server.
            $args = array(
                'user-agent' => 'beau-user-agent',
            );
            $remote_config = wp_remote_retrieve_body( wp_remote_get( $url, $args ) );
            $remote_config = json_decode( $remote_config, true );
            if ( ! empty( $remote_config ) && $remote_config && function_exists( 'json_last_error' ) && json_last_error() === JSON_ERROR_NONE ) {
                set_transient($key, $remote_config, 10 );
            }
        }
        public function get_count_apply(){
            $local = get_transient('beauadmin-patcher-local');
            $i=0;
            if(!is_array($local)){
                return false;
            }
            foreach ($this->patch as $key => $value) {
                if($value['status'] != '1'){
                    $i++;
                }
            }
            set_transient( 'beauadmin-patcher-count', $i );
        }
        /**
         * Make Log Path
         * @date        2017-06-26
         * @access public
         * @return
         */
        public function set_log(){
            $file_name      = 'beauadmin-patcher/Patcher.dat';
            $file = new BeauAdmin_Filesystem( $file_name );
            if(!is_array(get_transient('beauadmin-patcher'))) {
                $file->rm_file();
                return false;
            }
            if(!file_exists($file->get_path())){
                $file->write_file(json_encode(get_transient('beauadmin-patcher')));
                $this->patch = get_transient('beauadmin-patcher');
            }
            else {
                $this->get_url_key($file->get_url(false),'beauadmin-patcher-local');
            }
            $local = get_transient('beauadmin-patcher-local');
            if(!is_array($local)) {
                return false;
            }
            $remote = get_transient('beauadmin-patcher');
            $local_total = count($local);
            $remote_total = count($remote);
            $patch_merge = [];
            if($local_total < $remote_total){
                $this->patch = $remote+$local;
                $file->write_file(json_encode($this->patch));

            }
            else {
                $this->patch = $local;
            }
        }
        /**
         * The admin-page contents.
         *
         * @access public
         * @since 1.0.0
         */
        public function admin_page() {
            ?>
            <div class="wrap beau-wrap">
                <?php
                /**
                 * Make sure that any patches marked as manually applied
                 */
                // $this->manually_applied_patches();
                ?>

                <?php
                /**
                 * Adds the content of the form.
                 */
                do_action( 'beau_admin_pages_patcher' );
                ?>
                <?php
                /**
                 * Add the footer content.
                 */
                $this->footer_content();
                ?>
            </div>
            <?php
        }
        public static function get_instance() {

            // If the single instance hasn't been set yet, set it now.
            if ( null === self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;

        }
        /**
         * Footer content.
         *
         * @access protected
         * @since 1.0.0
         */
        protected function footer_content() {
        }

        public function form(){
            if(!is_array($this->patch)) {
                return false;
            }
            $patches = $this->patch;
            $available_patches = array();
            if (is_array($patches) || is_object($patches)) {
                foreach ( $patches as $patch_id => $patch_args ) {
                    if(($patch_args['version']) === BeauAdmin()->theme_version) {
                        $available_patches[] = $patch_id;
                    }

                }
            }
            // Make sure we have a unique array.
            $available_patches = array_unique( $available_patches );
            // Sort the array by value and re-index the keys.
            sort( $available_patches );
            // Get the array of messages to display.
            $messages = BeauAdmin_Patcher_Admin_Notices::get_messages();
            ?>
            <div class="beau-important-notice">
                <p class="description">
                    <?php if ( empty( $available_patches ) ) : ?>
                        <?php printf( esc_html__( 'Patcher: Currently there are no patches available for %1$s version %2$s', 'beauadmin' ), esc_attr( BeauAdmin()->theme_name ), esc_attr( BeauAdmin()->theme_version ) ); ?>
                        <?php else : ?>
                        <?php printf( esc_html__( 'Patcher: The following patches are available for %1$s version %2$s', 'beauadmin' ), esc_attr( BeauAdmin()->theme_name ), esc_attr( BeauAdmin()->theme_version ) ); ?>
                    <?php endif; ?>
                </p>
                <?php if ( ! empty( $available_patches ) ) : ?>
                <p class="sub-description">
                    <?php esc_html_e('The status column displays if a patch was applied. However, a patch can be reapplied if necessary.','beauadmin')?>
                    </p>
                <?php endif; ?>
                <?php if ( ! empty( $messages ) ) : ?>
                    <?php foreach ( $messages as $message_id => $message ) : ?>
                        <?php if ( false !== strpos( $message_id, 'write-permissions-' ) ) : ?>
                            <?php continue; ?>
                        <?php endif; ?>
                        <p class="beau-patcher-error"><?php echo wp_kses_post( $message ); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php if ( ! empty( $available_patches ) )  : ?>
                <div class="beau-patcher-content">
                    <table class="beau-patcher-table">
                       <tbody>
                            <tr class="beau-patcher-headings">
                                <th><?php esc_html_e('Patch #','beauadmin')?></th>
                                <th><?php esc_html_e('Description','beauadmin');?></th>
                                <th><?php esc_html_e('Status','beauadmin');?></th>
                                <th></th>
                            </tr>
                            <?php
                                foreach ( $available_patches as $key => $patch_id ) :
                                    // Do not allow applying the patch initially.
                                    // We'll have to check if they can later.
                                    $can_apply = false;

                                    // Make sure the patch exists.
                                    if ( ! array_key_exists( $patch_id, $patches ) ) {
                                        continue;
                                    }
                                    $patch_args = $patches[ $patch_id ];

                                    // If there is no previous patch, we can apply it.
                                    if ( ! isset( $available_patches[ $key - 1] )) {
                                        $can_apply = true;
                                    }

                                    // // If the previous patch exists and has already been applied,
                                    // // then we can apply this one.
                                    if ( isset( $available_patches[ $key - 1 ] )) {
                                        if ( $patches[$available_patches[ $key - 1]]['status'] == 1 ) {
                                            $can_apply = true;
                                        }
                                    }
                                    $patch_path = ['patch' => $patch_args['patch']];

                            ?>

                            <tr class="beau-patcher-table-head">
                                <td class="patch-id">
                                    <?php echo sprintf('#%s',$patch_id);?>
                                    <?php if(isset($patch_args['date'])) :?>
                                    <div class="date">
                                       <?php echo esc_attr($patch_args['date']);?>
                                    </div>
                                    <?php endif;?>
                                 </td>
                                <td class="patch-description">
                                <?php if ( isset( $messages[ 'write-permissions-' . $patch_id ] ) ) : ?>
                                    <div class="beau-patcher-error" style="font-size:.85rem;">
                                        <?php echo wp_kses_post( $messages[ 'write-permissions-' . $patch_id ] ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($patch_args['description'])) :?>
                                    <?php echo sprintf('<p>%s</p>',wp_kses_post($patch_args['description']));?>
                                <?php endif;?>
                                </td>
                                <td class="patch-status">
                                    <?php if ( $patch_args['status'] == 1 ) : ?>
                                        <span class="dashicons dashicons-yes"></span>
                                    <?php endif; ?>
                                </td>
                                <td class="patch-apply">
                                <?php if ($can_apply ) : ?>
                                        <?php if ( $patch_args['status'] == 1 ) : ?>
                                            <?php submit_button(esc_attr__('Patch Applied','beauadmin') ,'primary','',true,'data-type="beau_patcher" data-patch="reapp" data-patch-ser="'.wp_create_nonce( 'patch-app' ).'" data-patch-id="'.$patch_id.'" data-patch-path="'.BeauAdmin()->helper->encode(json_encode($patch_path)).'"'); ?>
                                        <?php else : ?>
                                            <?php submit_button(esc_attr__('Apply Patch','beauadmin') ,'primary','',true,'data-type="beau_patcher" data-patch="app" data-patch-ser="'.wp_create_nonce( 'patch-app' ).'" data-patch-id="'.$patch_id.'" data-patch-path="'.BeauAdmin()->helper->encode(json_encode($patch_path)).'"'); ?>
                                        <?php endif; ?>
                                <?php else : ?>
                                    <span class="button disabled button-small">
                                        <?php if ( isset( $available_patches[ $key - 1 ] ) ) : ?>
                                            <?php printf( esc_html__( 'Please apply patch #%s first.', 'beauadmin' ), ( intval($available_patches[ $key - 1 ]) )); ?>
                                        <?php else : ?>
                                            <?php esc_html_e( 'Patch cannot be currently aplied.', 'beauadmin' ); ?>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>

                                </td>
                            </tr>
                            <?php endforeach;?>
                       </tbody>
                    </table>
                </div>
            <?php
            endif;
            BeauAdmin_Patcher_Admin_Notices::remove_messages_option(false);
        }

        /**
         * [patcher_apply_callback description]
         * @access public
         * @return  false
         */
        public function patcher_apply_callback() {
            global $wpdb,$wp_filesystem; // this is how you get access to the database
            check_ajax_referer( 'patch-app', 'security' );
            $patch_id = intval( $_POST['patch_id'] );
            $type = intval( $_POST['type'] );
            $patch_path = ( $_POST['patch_path'] );
            $patcher = $this->patch;
            $patch_path =  json_decode(BeauAdmin()->helper->decode($patch_path));
            if(!is_object($patch_path)) {
                return false;
            }
            if(is_object($patch_path)){
                $args = (array) $patch_path;
                $status = 0;
                foreach ($args['patch'] as $key => $value) {
                    $path = $value->path;
                    $source = BeauAdmin()->helper->decode($value->reference);
                    $target = wp_normalize_path( get_template_directory());
                    $file = new BeauAdmin_Patcher_Filesystem($target,$source,$path,$patch_id);
                    if($file->status != false){
                        $status = 1;
                    }
                }
                if($status != 1) {
                    return false;
                }
                if(array_key_exists($patch_id,$patcher)) {
                    if($type == 'app'){
                        $patcher[$patch_id]['status'] = 1;
                        $log_file      = 'beauadmin-patcher/Patcher.dat';
                        $log = new BeauAdmin_Filesystem( $log_file );
                        $log->write_file(json_encode($patcher));
                    }
                }
            }
          die();
        }
    }
}