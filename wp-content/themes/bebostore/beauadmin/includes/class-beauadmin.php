<?php
/**
 * BeauAdmin
 * PHP Version 5
 * @package BeauAdmin
 * @author VNMilky (BeauAgency) <vnmilky.dev@gmail.com>
 * @copyright 2017 - Hanoi/VietNam
 * @version 1.0.0
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'BeauAdmin' ) ) {
    /**
     * The main class.
     */

    class BeauAdmin {
        /**
         * The arguments used in the constructor.
         *
         * @access private
         * @since 1.0.0
         * @var array
         */
        private $args = array();
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
         * Theme Version
         *
         * @static
         * @access protected
         * @var string
         */
        public static $version_theme;
        /**
         * Theme text-domain
         *
         * @static
         * @access protected
         * @var string
         */
        public static $theme_text_domain;
        /**
         * The template directory path.
         *
         * @static
         * @access public
         * @var string
         */
        public static $template_dir_path = '';
        /**
         * The template directory URL.
         *
         * @static
         * @access public
         * @var string
         */
        public static $template_dir_url = '';
        /**
         * The root of the remote server where demos are off-loaded.
         *
         * @static
         * @access protected
         * @var string
         */
        protected static $remote_server;
         /**
         * The root of the remote server where demos are off-loaded.
         *
         * @static
         * @access protected
         * @var string
         */
        protected static $remote_plugins;
        function __construct(){
            $this->template = get_option('template');
            if($this->template != ''){
                add_option('beau_'.$this->template.'_name',ucfirst($this->template),'','yes');
                add_option('beau_'.$this->template.'_ver',self::$version_theme,'','yes');
                if(get_option('beau_'.$this->template.'_ver')) {
                    update_option('beau_'.$this->template.'_ver',self::$version_theme,'','yes');
                }
                self::$remote_server = 'http://api.beautheme.com/?beau_admin='.$this->template;
                self::$remote_plugins = 'http://api.beautheme.com/?beau_plugin='.$this->template;
                $this->theme_name = get_option('beau_'.$this->template.'_name');
                $this->theme_version = get_option('beau_'.$this->template.'_ver');
            }
            if ( '' === self::$template_dir_path ) {
                self::$template_dir_path = wp_normalize_path( get_template_directory() ).'/beauadmin/';
            }
            if ( '' === self::$template_dir_url ) {
                self::$template_dir_url = get_template_directory_uri().'/beauadmin/';
            }

            $this->TGM_Plugin_Activation();
            $this->get_url_key(self::$remote_server,'beauadmin-config');
            $this->config = get_transient('beauadmin-config');
            $this->get_count_check_update();
            $this->get_url_key(self::$remote_plugins,'beauadmin-plugins');
            $this->bundled_plugins = get_transient('beauadmin-plugins');
            add_action( 'wp_before_admin_bar_render', array($this,'toolbar_admin' ));
            add_action( 'admin_menu',array($this,'admin_menu'));
            add_action( 'admin_menu', array( $this, 'edit_admin_menus' ), 999 );
            add_action( 'after_switch_theme', array( $this, 'activation_redirect' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
            $this->init_registers = new BeauAdmin_Register();
            $this->helper = new BeauAdmin_Helper();
            $this->patcher = new BeauAdmin_Patcher();
            $this->init_dashboard = new BeauAdmin_Dashboard();
            add_action('admin_notices', [$this,'check_update'],4);
            add_action('network_admin_notices', [$this,'check_update'],4);
            if($this->bundled_plugins != false){
                add_action( 'tgmpa_register', array($this,'register_required_plugins' ));
                add_filter( 'tgmpa_notice_action_links', array( $this, 'edit_tgmpa_notice_action_links' ) );
                add_filter( 'tgmpa_show_admin_notice_capability', array($this,'tgm_show_admin_notice_capability') );
                add_action( 'admin_init', array( $this, 'admin_init' ) );

            }
            $this->remove_cached();

        }
         //Load TMG
        public function TGM_Plugin_Activation() {
            include_once wp_normalize_path(self::$template_dir_path. '/includes/class-tgm-plugin-activation.php');
        }
        /**
         * Get the args.
         *
         * @access public
         * @since 1.0.0
         * @param false|string $arg Get a specific argument, or get all.
         * @return array|string
         */
        public function get_args( $arg = false ) {
            if ( false !== $arg ) {
                if ( isset( $this->args[ $arg ] ) ) {
                    return $this->args[ $arg ];
                }
                return null;
            }
            return (array) $this->args;
        }
        public function check_update(){
           if($this->config['version'] != $this->theme_version ) {
                echo sprintf('<div class="notice notice-info is-dismissible"><p><strong>%s %s %s</strong> <a href="%s" target="_blank">%s</a></p></div>',$this->config['theme'],esc_html__('Available Version:','beauadmin'),$this->config['version'],$this->config['store'],esc_html__('Update Here !','beauadmin'));
           }
           else {
           }
        }
        //Remove Cache
        private function remove_cached(){
            $arrs = [
                'beauadmin-config',
                'beauadmin-patcher-count',
                'beauadmin-systems-count'
            ];
            if($this->config == false) {
                foreach ($arrs as $x => $s) {
                    delete_transient($s);
                }
            }
        }
        //Check Update Count
        private function get_count_check_update(){
            if($this->config['version'] !== $this->theme_version ) {
                set_transient( 'beauadmin-systems-count',1 );
            }
            else {
                delete_transient( 'beauadmin-systems-count');
           }
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
                set_transient($key, $remote_config, 60*60*24 );
            }
        }
        /**
         * Enqueue any scripts & stylesheets needed.
         *
         * @access public
         * @since 1.0.0
         */
        public function admin_scripts() {
            wp_enqueue_script('beauadmin',self::$template_dir_url.'/assets/js/main.js',array('jquery'),'1.1',true);
            wp_enqueue_style('beauadmin', self::$template_dir_url . '/assets/css/beauadmin.css', false, time() );

        }
        public static function get_instance() {
            if ( null === self::$instance ) {
                self::$instance = new BeauAdmin();
            }
            return self::$instance;
        }
        /**
         * Redirect to admin page on theme activation.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function activation_redirect() {
            if ( current_user_can( 'edit_theme_options' ) ) {
                header( 'Location:' . admin_url() . 'admin.php?page=beauadmin' );
            }
        }

        /**
         * Modify the menu.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function edit_admin_menus() {
            global $submenu;

            // Change Beau to Welcome.
            if ( current_user_can( 'edit_theme_options' ) ) {
                $submenu['beauadmin'][0][0] = esc_attr__( 'Welcome', 'beauadmin' );
            }

            if ( isset( $submenu['themes.php'] ) && ! empty( $submenu['themes.php'] ) ) {
                foreach ( $submenu['themes.php'] as $key => $value ) {
                    // Remove "Header" submenu.
                    if ( isset( $value[2] ) && false !== strpos( $value[2], 'customize.php' ) && false !== strpos( $value[2], '=header_image' ) ) {
                        unset( $submenu['themes.php'][ $key ] );
                    }
                    // Remove "Background" submenu.
                    if ( isset( $value[2] ) && false !== strpos( $value[2], 'customize.php' ) && false !== strpos( $value[2], '=background_image' ) ) {
                        unset( $submenu['themes.php'][ $key ] );
                    }

                }

                // Reorder items in the array.
                $submenu['themes.php'] = array_values( $submenu['themes.php'] );
            }

            // Remove TGMPA menu from Appearance.
            remove_submenu_page( 'themes.php', 'install-required-plugins' );
            remove_submenu_page( 'themes.php', 'beauadmin-plugins' );

        }


        /**
         * Add menu to Toolbar
         *
         * @access private
         * @since 1.0.0
         * @return
         */
        private function add_wp_toolbar( $title, $parent = false, $href = '', $meta = array(), $id_element = ''){
            global $wp_admin_bar;

            if ( current_user_can( 'edit_theme_options' ) ) {
                if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
                    return;
                }
                // Set custom ID
                if ( $id_element ) {
                    $id_element = $id_element;
                } else {
                    $id_element = strtolower( str_replace( ' ', '-', $title ) );
                }

                $meta = strpos( $href, site_url() ) !== false ? array() : array( 'target' => '_blank' ); // open in new tab
                $meta = array_merge( $meta, $meta );

                $wp_admin_bar->add_node( array(
                    'parent' => $parent,
                    'id'     => $id_element,
                    'title'  => $title,
                    'href'   => $href,
                    'meta'   => $meta,
                ) );
            }
        }
        /**
         * Add menu to Toolbar
         *
         * @access public
         * @since 1.0.0
         * @return
         */
        public function toolbar_admin(){
            global $wp_admin_bar;
            if ( current_user_can( 'edit_theme_options' ) ) {
                $parent_menu_title = '<span class="dashicons-beau-admin"></span> <span class="ab-label">Beau Admin</span>';
                $this->add_wp_toolbar( $parent_menu_title, false, admin_url( 'admin.php?page=beauadmin' ), array( 'class' => 'beauadmin-menu' ), 'beauadmin' );
            }
        }
        public function admin_menu(){
            if ( current_user_can( 'edit_theme_options' ) ) {
                $plugins_callback = array( $this, 'plugins_tab' );

                if ( isset( $_GET['tgmpa-install'] ) || isset( $_GET['tgmpa-update'] ) ) {
                    require_once wp_normalize_path(self::$template_dir_path . '/includes/class-tgm-plugin-activation.php');
                    remove_action( 'admin_notices', array( $GLOBALS['tgmpa'], 'notices' ) );
                    $plugins_callback = array( $GLOBALS['tgmpa'], 'install_plugins_page' );
                }
                //Change add_theme_page for add_menu_page and add_sub_menu_page
                $beau = "add_";
                $metho = $beau."menu_page";
                $metho_sub = $beau."submenu_page";
                //Patch Count
                $patcher_count = get_transient('beauadmin-patcher-count');
                //System Count
                $system_count = get_transient('beauadmin-systems-count');;
                //Total Count
                $total_count = $patcher_count + $system_count;
                 if($patcher_count != '') {
                    $total_label = sprintf( esc_attr__( 'Beau Admin %s','beauadmin' ), "<span class='update-plugins count-$total_count' ><span class='update-count'>" . number_format_i18n($total_count) . "</span></span>" );
                }
                else {
                    $total_label = esc_attr__( 'Beau Admin', 'beauadmin' );
                }
                $welcome = $metho( 'Beau Admin',$total_label, 'edit_theme_options', 'beauadmin', array( $this, 'welcome_tab' ), 'dashicons-beau-admin', '2.111111' );
                $registration       = $metho_sub( 'beauadmin', esc_attr__( 'Registration', 'beauadmin' ), esc_attr__( 'Registration', 'beauadmin' ), 'edit_theme_options', 'beauadmin-registration', array( $this, 'registration_tab' ) );
                if(class_exists('BeauCore_Import')){

                   $demos       = $metho_sub( 'beauadmin', esc_attr__( 'Demos', 'beauadmin' ), esc_attr__( 'Demos', 'beauadmin' ), 'import', 'beauadmin-demos', array(BeauCore::get_instance()->import->init,'display_plugin_page'));
                }


                $support       = $metho_sub( 'beauadmin', esc_attr__( 'Support', 'beauadmin' ), esc_attr__( 'Support', 'beauadmin' ), 'edit_theme_options', 'beauadmin-support', array( $this, 'support_tab' ) );
                $faqs       = $metho_sub( 'beauadmin', esc_attr__( 'FAQs', 'beauadmin' ), esc_attr__( 'FAQs', 'beauadmin' ), 'edit_theme_options', 'beauadmin-faqs', array( $this, 'faqs_tab' ) );

                $plugins       = $metho_sub( 'beauadmin', esc_attr__( 'Plugins', 'beauadmin' ), esc_attr__( 'Plugins', 'beauadmin' ), 'install_plugins', 'beauadmin-plugins', $plugins_callback );

                if($patcher_count != '') {
                    $patcher_label = sprintf( esc_attr__( 'Patcher %s','beauadmin' ), "<span class='update-plugins count-$patcher_count' ><span class='update-count'>" . number_format_i18n($patcher_count) . "</span></span>" );
                }
                else {
                    $patcher_label = esc_attr__( 'Patcher', 'beauadmin' );
                }
                $patcher       = $metho_sub( 'beauadmin', esc_attr__( 'Patcher', 'beauadmin' ), $patcher_label, 'edit_theme_options', 'beauadmin-patcher', array( $this, 'patcher_tab' ) );
                if($system_count) {
                    $system_label = sprintf( esc_attr__( 'System Status %s','beauadmin' ), "<span class='update-plugins count-$system_count' ><span class='update-count'>" . number_format_i18n($system_count) . "</span></span>" );
                }
                else {
                    $system_label = esc_attr__( 'System Status', 'beauadmin' );
                }
                $system       = $metho_sub( 'beauadmin',esc_attr__( 'System Status', 'beauadmin' ),  $system_label, 'edit_theme_options', 'beauadmin-systems', array( $this, 'systems_tab' ) );

                add_action( 'admin_print_scripts-' . $welcome, array( $this, 'welcome_screen_scripts' ) );
                add_action( 'admin_print_scripts-' . $registration, array( $this, 'registration_screen_scripts' ) );
                add_action( 'admin_print_scripts-' . $patcher, array( $this, 'patcher_apply_javascript' ) );


            }
        }
        public function welcome_screen_scripts() {

            wp_enqueue_script( 'welcome',BeauAdmin::$template_dir_url.'assets/js/welcome.js',array('jquery'),'1.1',true);

        }
        public function patcher_apply_javascript() {
            wp_enqueue_script( 'patcher',BeauAdmin::$template_dir_url.'assets/js/patcher.js',array('jquery'),'1.1',true);
        }
        public function registration_screen_scripts() {

            wp_enqueue_script( 'registration',BeauAdmin::$template_dir_url.'assets/js/registration.js',array('jquery'),'1.1',true);

        }
        public function welcome_tab() {
            include_once wp_normalize_path(self::$template_dir_path. '/template/welcome.php');
        }
        public function registration_tab() {
            include_once wp_normalize_path(self::$template_dir_path. '/template/registration.php');
        }
        public function support_tab() {
            include_once wp_normalize_path(self::$template_dir_path. '/template/support.php');
        }
        public function faqs_tab() {
            include_once wp_normalize_path(self::$template_dir_path. '/template/faq.php');
        }
        public function plugins_tab() {
            include_once wp_normalize_path(self::$template_dir_path. '/template/plugins.php');
        }
        public function patcher_tab() {
            include_once wp_normalize_path(self::$template_dir_path. '/template/patcher.php');
        }
        public function systems_tab() {
            include_once wp_normalize_path(self::$template_dir_path. '/template/systems.php');
        }



        /**
         * Renders the admin screens header with title, logo and tabs.
         *
         * @since 1.0.0
         *
         * @access  public
         * @param string $screen The current screen.
         * @return void
         */
        public function get_admin_screens_header( $screen = 'welcome' ) {
            ?>
            <h1><?php esc_attr_e( 'Welcome to ', 'beauadmin' ); ?><?php echo $this->theme_name;?> <?php echo $this->theme_version;?></h1>
            <div class="about-text">
                <?php echo $this->config['welcome']['about'];?>
            </div>
            <div <?php if($this->config['avatar'] != false) { ?> class="beau-logo" data-logo="<?php echo esc_attr($this->config['avatar'])?>" <?php } else { ?> class="beau-logo no-avatar" <?php } ?>>
                </div>
            <h2 class="nav-tab-wrapper">
                <a href="<?php echo esc_url_raw( ( 'welcome' === $screen ) ? '#' : admin_url( 'admin.php?page=beauadmin' ) ); ?>" class="<?php echo ( 'welcome' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'Welcome', 'beauadmin' ); ?></a>
                  <a href="<?php echo esc_url_raw( ( 'registration' === $screen ) ? '#' : admin_url( 'admin.php?page=beauadmin-registration' ) ); ?>" class="<?php echo ( 'registration' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'Registration', 'beauadmin' ); ?></a>
                 <?php if(class_exists('BeauCore_Import')): ?>

                <a href="<?php echo esc_url_raw( ( 'demos' === $screen ) ? '#' : admin_url( 'admin.php?page=beauadmin-demos' ) ); ?>" class="<?php echo ( 'demos' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'Demos', 'beauadmin' ); ?></a>
                <?php endif;?>
                <a href="<?php echo esc_url_raw( ( 'support' === $screen ) ? '#' : admin_url( 'admin.php?page=beauadmin-support' ) ); ?>" class="<?php echo ( 'support' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'Support', 'beauadmin' ); ?></a>

                 <a href="<?php echo esc_url_raw( ( 'faqs' === $screen ) ? '#' : admin_url( 'admin.php?page=beauadmin-faqs' ) ); ?>" class="<?php echo ( 'faqs' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'FAQs', 'beauadmin' ); ?></a>

                <a href="<?php echo esc_url_raw( ( 'plugins' === $screen ) ? '#' : admin_url( 'admin.php?page=beauadmin-plugins' ) ); ?>" class="<?php echo ( 'plugins' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'Plugins', 'beauadmin' ); ?></a>

                 <a href="<?php echo esc_url_raw( ( 'patcher' === $screen ) ? '#' : admin_url( 'admin.php?page=beauadmin-patcher' ) ); ?>" class="<?php echo ( 'patcher' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'Patcher', 'beauadmin' ); ?></a>

                <a href="<?php echo esc_url_raw( ( 'systems' === $screen ) ? '#' : admin_url( 'admin.php?page=beauadmin-systems' ) ); ?>" class="<?php echo ( 'systems' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'System Status', 'beauadmin' ); ?></a>
            </h2>
            <?php
        }
        public function get_admin_screens_footer() {
            ?>
            <div class="beau-thanks">
               <?php echo wp_kses_post($this->config['footer_text']);?>
            </div>
            <?php
        }

        public function register_required_plugins() {
            $theme_text_domain = $this->template;
            /*
             * Array of plugin arrays. Required keys are name and slug.
             * If the source is NOT from the .org repo, then source is also required.
             */
            $plugins = $this->bundled_plugins['plugins'];
            /*
             * Array of configuration settings. Amend each line as needed.
             *
             * TGMPA will start providing localized text strings soon. If you already have translations of our standard
             * strings available, please help us make TGMPA even better by giving us access to these translations or by
             * sending in a pull-request with .po file(s) with the translations.
             *
             * Only uncomment the strings in the config array if you want to customize the strings.
             */
            $config = array(
            'domain'            => self::$theme_text_domain,
            'default_path'      => '',
            'parent_slug'       => 'beauadmin',
            'menu'              => 'beauadmin-plugins',
            'has_notices'  => true,
            'dismissable'  => true,
            'dismiss_msg'  => '',
            'is_automatic' => false,
            'message'      => '',

        );
            tgmpa( $plugins, $config );
        }
                /**
         * Get the plugin link.
         *
         * @access  public
         * @param array $item The plugin in question.
         * @return  array
         */
        public function plugin_link( $item ) {
            $installed_plugins = get_plugins();

            $item['sanitized_plugin'] = $item['name'];

            $actions = array();

            // We have a repo plugin.
            if ( ! $item['version'] ) {
                $item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
            }

            $disable_class = '';
            $data_version  = '';


            // We need to display the 'Install' hover link.
            if ( ! isset( $installed_plugins[ $item['file_path'] ] ) ) {
                if ( ! $disable_class ) {
                    $url = esc_url( wp_nonce_url(
                        add_query_arg(
                            array(
                                'page'          => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
                                'plugin'        => rawurlencode( $item['slug'] ),
                                'plugin_name'   => rawurlencode( $item['sanitized_plugin'] ),
                                'tgmpa-install' => 'install-plugin',
                                'return_url'    => 'beau_plugins',
                            ),
                            TGM_Plugin_Activation::$instance->get_tgmpa_url()
                        ),
                        'tgmpa-install',
                        'tgmpa-nonce'
                    ) );
                } else {
                    $url = '#';
                }
                $actions = array(
                    'install' => '<a href="' . $url . '" class="button button-primary' . $disable_class . '"' . $data_version . ' title="' . sprintf( esc_attr__( 'Install %s', 'beauadmin' ), $item['sanitized_plugin'] ) . '">' . esc_attr__( 'Install', 'beauadmin' ) . '</a>',
                );
            } elseif ( is_plugin_inactive( $item['file_path'] ) ) {
                // We need to display the 'Activate' hover link.
                $url = esc_url( add_query_arg(
                    array(
                        'plugin'               => rawurlencode( $item['slug'] ),
                        'plugin_name'          => rawurlencode( $item['sanitized_plugin'] ),
                        'beauadmin-activate'       => 'activate-plugin',
                        'beauadmin-activate-nonce' => wp_create_nonce( 'beauadmin-activate' ),
                    ),
                    admin_url( 'admin.php?page=beauadmin-plugins' )
                ) );

                $actions = array(
                    'activate' => '<a href="' . $url . '" class="button button-primary"' . $data_version . ' title="' . sprintf( esc_attr__( 'Activate %s', 'beauadmin' ), $item['sanitized_plugin'] ) . '">' . esc_attr__( 'Activate' , 'beauadmin' ) . '</a>',
                );
            } elseif ( version_compare( $installed_plugins[ $item['file_path'] ]['Version'], $item['version'], '<' ) ) {
                $disable_class = '';
                // We need to display the 'Update' hover link.
                $url = wp_nonce_url(
                    add_query_arg(
                        array(
                            'page'          => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
                            'plugin'        => rawurlencode( $item['slug'] ),
                            'tgmpa-update'  => 'update-plugin',
                            'version'       => rawurlencode( $item['version'] ),
                            'return_url'    => 'beau_plugins',
                        ),
                        TGM_Plugin_Activation::$instance->get_tgmpa_url()
                    ),
                    'tgmpa-update',
                    'tgmpa-nonce'
                );

                $actions = array(
                    'update' => '<a href="' . $url . '" class="button button-primary' . $disable_class . '" title="' . sprintf( esc_attr__( 'Update %s', 'beauadmin' ), $item['sanitized_plugin'] ) . '">' . esc_attr__( 'Update', 'beauadmin' ) . '</a>',
                );
            } elseif ( is_plugin_active( $item['file_path'] ) ) {
                $url = esc_url( add_query_arg(
                    array(
                        'plugin'                 => rawurlencode( $item['slug'] ),
                        'plugin_name'            => rawurlencode( $item['sanitized_plugin'] ),
                        'beauadmin-deactivate'       => 'deactivate-plugin',
                        'beauadmin-deactivate-nonce' => wp_create_nonce( 'beauadmin-deactivate' ),
                    ),
                    admin_url( 'admin.php?page=beauadmin-plugins' )
                ) );
                $actions = array(
                    'deactivate' => '<a href="' . $url . '" class="button button-primary" title="' . sprintf( esc_attr__( 'Deactivate %s', 'beauadmin' ), $item['sanitized_plugin'] ) . '">' . esc_attr__( 'Deactivate', 'beauadmin' ) . '</a>',
                );
            } // End if.

            return $actions;
        }

        public function admin_init() {

            if ( current_user_can( 'edit_theme_options' ) ) {

                if ( isset( $_GET['beauadmin-deactivate'] ) && 'deactivate-plugin' === $_GET['beauadmin-deactivate'] ) {
                    check_admin_referer( 'beauadmin-deactivate', 'beauadmin-deactivate-nonce' );

                    $plugins = TGM_Plugin_Activation::$instance->plugins;

                    foreach ( $plugins as $plugin ) {
                        if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
                            deactivate_plugins( $plugin['file_path'] );
                        }
                    }
                }
                if ( isset( $_GET['beauadmin-activate'] ) && 'activate-plugin' === $_GET['beauadmin-activate'] ) {
                    check_admin_referer( 'beauadmin-activate', 'beauadmin-activate-nonce' );

                    $plugins = TGM_Plugin_Activation::$instance->plugins;

                    foreach ( $plugins as $plugin ) {
                        if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
                            activate_plugin( $plugin['file_path'] );

                            wp_safe_redirect( admin_url( 'admin.php?page=beauadmin-plugins' ) );
                            exit;
                        }
                    }
                }
            }
        }
        /**
         * Removes install link
         *
         * @since 5.0.0
         * @param array $action_links The action link(s) for a required plugin.
         * @return array The action link(s) for a required plugin.
         */
        public function edit_tgmpa_notice_action_links( $action_links ) {
            $link_template = '<a id="manage-plugins" class="button-primary" style="margin-top:1em;" href="' . esc_url( self_admin_url( 'admin.php?page=beauadmin-plugins' ) ) . '#beauadmin-install-plugins">' . esc_attr__( 'Go Manage Plugins', 'beauadmin' ) . '</a>';
                $action_links  = array(
                    'install' => $link_template,
                );
            return $action_links;
        }
        /**
         * Returns the user capability for showing the notices.
         *
         * @return string
         */
        function tgm_show_admin_notice_capability() {
            return 'edit_theme_options';
        }
    }
}