<?php

/**
 * Redux
 *
 * @author     VNMilky <vnmilky.dev@gmail.com>
 * @copyright  (c) 2017 VNMilky
 * @package    Beau_Update
 * @subpackage Redux
 * @version    1.0.0
 */


namespace Beau_Update;


// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

if (!class_exists('ReduxFramework')) {
    require_once wp_normalize_path(__DIR__ . '/Redux/ReduxCore/framework.php');
}

class Redux
{
    private static $key;

    protected static $redux_dir;

    protected static $redux_url;

    private $custom_field = array();

    /**
     * @return mixed
     */
    public static function getKey()
    {
        return self::$key;
    }

    /**
     * @return mixed
     */
    public static function getReduxDir()
    {
        return self::$redux_dir;
    }

    /**
     * @return mixed
     */
    public static function getReduxUrl()
    {
        return self::$redux_url;
    }

    /**
     * Redux constructor.
     */
    public function __construct($opt_name)
    {
        self::$key = $opt_name;
        self::$redux_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__).'/Redux/'));
        self::$redux_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', self::$redux_dir));

        if ( ! defined( 'MILKCORE_AJAX_SAVE' ) ) {
            define( 'MILKCORE_AJAX_SAVE', true );
        }
        $GLOBALS['redux_notice_check'] = 1;

        $this->__register_custom_fields();
        $this->__load_extensions();
        $this->__load_action();
        $this->__load_option_arg();


    }

    private function __load_option_arg()
    {
        $opt_name = $this->getKey();
        if (file_exists(BEAU_CORE_PATH . '/includes/options/default.php')) {
            include_once wp_normalize_path(BEAU_CORE_PATH . '/includes/options/default.php');

        }
        foreach (glob(BEAU_CORE_PATH . 'includes/options/options-*.php', GLOB_NOSORT) as $filename) {
            include wp_normalize_path($filename);
        }
    }

    /**
     * __load_action
     * @access  public
     * @author  VNMilky <vnmilky.dev>
     * since    1.0.0
     */
    private function __load_action()
    {
        add_action('redux/page/' . self::$key . '/enqueue', array($this, 'enqueue'), 0);
        add_action('admin_head', array($this, 'dynamic_css'));
        add_filter('admin_body_class', function ($admin_body_classes) {
            global $pagenow;
            return 'admin.php' == $pagenow && substr_count( $admin_body_classes, 'woocommerce' ) == 0 ? $admin_body_classes .= ' beau_option_woocommerce ' : $admin_body_classes;
        });
    }

    /**
     * __register_custom_fields
     * @access  public
     * @author  VNMilky <vnmilky.dev>
     * @since    1.0.0
     * @return void
     *
     */
    private function __register_custom_fields()
    {
        $this->custom_field = array(
            'color_alpha',
        );
        foreach ($this->custom_field as $field) {
            add_action('redux/' . $this->getKey() . '/field/class/' . $field, function () use ($field) {
                return $this->getReduxDir() . 'custom-fields/' . $field . '/field_' . $field . '.php';
            });
        }
    }

    public function enqueue()
    {
        wp_enqueue_style(
            'beau-redux-custom-css',
            $this->getReduxUrl() . 'dist/style.css',
            '',
            filemtime($this->getReduxDir() . 'dist/style.css'),
            'all'
        );
        wp_enqueue_script(
            'beau-redux-custom-js',
            $this->getReduxUrl() . 'dist/redux.js',
            array('jquery'),
            time(),
            true
        );
        $vars = array(
            'option_name' => $this->getKey(),
            'theme_skin' => esc_html__('Theme Skin', 'beau-redux'),
            'color_scheme' => esc_html__('Color Scheme', 'beau-redux'),
        );
        wp_localize_script('beau-redux-custom-js', 'reduxVars', $vars);
    }

    private function __load_extensions()
    {
        add_action('redux/extensions/' . $this->getKey() . '/before', function ($ReduxFramework) {
            $path = $this->getReduxDir() . 'extensions/';
            $folders = scandir($path, 1);
            foreach ($folders as $folder) {
                if ($folder === '.' or $folder === '..' or !is_dir($path . $folder)) {
                    continue;
                }
                $extension_class = 'ReduxFramework_Extension_' . $folder;
                if (!class_exists($extension_class)) {
                    // In case you wanted override your override, hah.
                    $class_file = $path . $folder . '/extension_' . $folder . '.php';
                    $class_file = apply_filters('redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file);
                    if ($class_file) {
                        require_once($class_file);
                        new $extension_class($ReduxFramework);
                    }
                }
            }
        }, 0);
    }

    /**
     * dynamic_css
     *
     * @author VNMilky <vnmilky.dev@gmail.com>
     * @since 1.0.0
     */
    public function dynamic_css()
    {
        $screen = get_current_screen();
        // Early exit if we're not in the redux panel.
        if (is_null($screen) || 'appearance_page_beau_option' !== $screen->id && 'toplevel_page_beau_option' !== $screen->id && 'beau-admin_page_beau_option' !== $screen->id) {
            return;
        }

        // Get the user's admin colors.
        $color_scheme = get_user_option('admin_color');

        // If no theme is active set it to 'fresh'.
        if (empty($color_scheme)) {
            $color_scheme = 'fresh';
        }

        $main_colors = $this->get_main_colors($color_scheme);
        $text_colors = $this->get_text_colors($color_scheme);

        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once wp_normalize_path(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }
        /**
         * @var $wp_filesystem WP_Filesystem_Base
         */
        $styles = $wp_filesystem->get_contents($this->getReduxUrl() . '/dist/style.css');
        if (!$styles || empty($styles)) {
            ob_start();
            include wp_normalize_path($this->getReduxDir() . '/dist/style.css');
            $styles = ob_get_clean();
        }
        if ($styles && !empty($styles)) {

            $redux_logo = $this->getReduxUrl() . '/dist/beau-core.png';
            $redux_del_option = $this->getReduxUrl() . '/dist/del.png';
            $redux_add_option = $this->getReduxUrl() . '/dist/add.png';
            $styles = str_replace('$color_back_1', $main_colors['color_back_1'], $styles);
            $styles = str_replace('$color_back_2', $main_colors['color_back_2'], $styles);
            $styles = str_replace('$color_back_top_level_hover', $main_colors['color_back_top_level_hover'], $styles);
            $styles = str_replace('$color_back_top_level_active', $main_colors['color_back_top_level_active'], $styles);
            $styles = str_replace('$color_accent_1', $main_colors['color_accent_1'], $styles);
            $styles = str_replace('$color_accent_2', $main_colors['color_accent_2'], $styles);

            $styles = str_replace('$color_text_menu_top_level_hover', $text_colors['menu_top_level_hover'], $styles);
            $styles = str_replace('$color_text_menu_sub_level_hover', $text_colors['menu_sub_level_hover'], $styles);
            $styles = str_replace('$color_text_menu_top_level_active', $text_colors['menu_top_level_active'], $styles);
            $styles = str_replace('$color_text_menu_sub_level_active', $text_colors['menu_sub_level_active'], $styles);
            $styles = str_replace('$color_text_menu_top_level', $text_colors['menu_top_level'], $styles);
            $styles = str_replace('$color_text_menu_sub_level', $text_colors['menu_sub_level'], $styles);
            $styles = str_replace('$redux_logo', $redux_logo, $styles);
            $styles = str_replace('$redux_del_option', $redux_del_option, $styles);
            $styles = str_replace('$redux_add_option', $redux_add_option, $styles);
            // @codingStandardsIgnoreLine
            echo '<style id="beau-redux-custom-styles" type="text/css">' . $styles . '</style>';

        }
    }

    /**
     * Gets the text colors depending on the admin-color-scheme.
     *
     * @author VNMilky <vnmilky.dev@gmail.com>
     * @since 1.0.0
     * @param $scheme
     * @return array
     */
    private function get_text_colors($scheme)
    {
        $text_colors = array();

        switch ($scheme) {
            case 'fresh':
                $text_colors['menu_top_level'] = '#eee';
                $text_colors['menu_sub_level'] = 'rgba(240, 245, 250, 0.7)';
                $text_colors['menu_top_level_hover'] = '#00b9eb';
                $text_colors['menu_sub_level_hover'] = '#00b9eb';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#fff';
                break;
            case 'light':
                $text_colors['menu_top_level'] = '#333';
                $text_colors['menu_sub_level'] = '#686868';
                $text_colors['menu_top_level_hover'] = '#fff';
                $text_colors['menu_sub_level_hover'] = '#00b9eb';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#333';
                break;
            case 'blue':
                $text_colors['menu_top_level'] = '#fff';
                $text_colors['menu_sub_level'] = '#e2ecf1';
                $text_colors['menu_top_level_hover'] = '#fff';
                $text_colors['menu_sub_level_hover'] = '#fff';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#fff';
                break;
            case 'coffee':
                $text_colors['menu_top_level'] = '#fff';
                $text_colors['menu_sub_level'] = '#cdcbc9';
                $text_colors['menu_top_level_hover'] = '#fff';
                $text_colors['menu_sub_level_hover'] = '#c7a589';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#fff';
                break;
            case 'ectoplasm':
                $text_colors['menu_top_level'] = '#fff';
                $text_colors['menu_sub_level'] = '#cbc5d3';
                $text_colors['menu_top_level_hover'] = '#fff';
                $text_colors['menu_sub_level_hover'] = '#a3b745';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#fff';
                break;
            case 'midnight':
                $text_colors['menu_top_level'] = '#fff';
                $text_colors['menu_sub_level'] = '#c3c4c5';
                $text_colors['menu_top_level_hover'] = '#fff';
                $text_colors['menu_sub_level_hover'] = '#e14d43';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#fff';
                break;
            case 'ocean':
                $text_colors['menu_top_level'] = '#fff';
                $text_colors['menu_sub_level'] = '#d5dde0';
                $text_colors['menu_top_level_hover'] = '#fff';
                $text_colors['menu_sub_level_hover'] = '#9ebaa0';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#fff';
                break;
            case 'sunrise':
                $text_colors['menu_top_level'] = '#fff';
                $text_colors['menu_sub_level'] = '#f1c8c7';
                $text_colors['menu_top_level_hover'] = '#fff';
                $text_colors['menu_sub_level_hover'] = '#f7e3d3';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#fff';
                break;
            default:
                $text_colors['menu_top_level'] = '#eee';
                $text_colors['menu_sub_level'] = 'rgba(240, 245, 250, 0.7)';
                $text_colors['menu_top_level_hover'] = '#00b9eb';
                $text_colors['menu_sub_level_hover'] = '#00b9eb';
                $text_colors['menu_top_level_active'] = '#fff';
                $text_colors['menu_sub_level_active'] = '#fff';
        }// End switch().

        return $text_colors;
    }

    /**
     * Gets the main admin-color scheme.
     *
     * @author VNMilky <vnmilky.dev@gmail.com>
     * @since 1.0.0
     * @param $scheme
     * @return array
     */
    private function get_main_colors($scheme)
    {
        $main_colors = array(
            'color_back_1' => '',
            'color_back_2' => '',
            'color_back_top_level_hover' => '',
            'color_back_top_level_active' => '',
            'color_accent_1' => '',
            'color_accent_2' => '',
        );

        // Get the active admin theme.
        global $_wp_admin_css_colors;

        if (!isset($_wp_admin_css_colors[$scheme])) {
            $scheme = 'fresh';
        }

        $colors = (array)$_wp_admin_css_colors[$scheme];

        if (isset($colors['colors'])) {
            $main_colors['color_accent_1'] = (isset($colors['colors'][2])) ? $colors['colors'][2] : $main_colors['color_accent_1'];
            $main_colors['color_accent_2'] = (isset($colors['colors'][3])) ? $colors['colors'][3] : $main_colors['color_accent_2'];
        }

        switch ($scheme) {
            case 'fresh':
                $main_colors['color_back_1'] = '#32373c';
                $main_colors['color_back_2'] = '#23282d';
                $main_colors['color_back_top_level_hover'] = '#191e23';
                $main_colors['color_back_top_level_active'] = '#0073aa';
                break;
            case 'light':
                $main_colors['color_back_1'] = '#fff';
                $main_colors['color_back_2'] = '#e5e5e5';
                $main_colors['color_back_top_level_hover'] = '#888';
                $main_colors['color_back_top_level_active'] = '#888';
                break;
            case 'blue':
                $main_colors['color_back_1'] = '#4796b3';
                $main_colors['color_back_2'] = '#52accc';
                $main_colors['color_back_top_level_hover'] = '#096484';
                $main_colors['color_back_top_level_active'] = '#096484';
                $main_colors['color_accent_1'] = '#e1a948';
                break;
            case 'coffee':
                $main_colors['color_back_1'] = '#46403c';
                $main_colors['color_back_2'] = '#59524c';
                $main_colors['color_back_top_level_hover'] = '#c7a589';
                $main_colors['color_back_top_level_active'] = '#c7a589';
                break;
            case 'ectoplasm':
                $main_colors['color_back_1'] = '#413256';
                $main_colors['color_back_2'] = '#523f6d';
                $main_colors['color_back_top_level_hover'] = '#a3b745';
                $main_colors['color_back_top_level_active'] = '#a3b745';
                break;
            case 'midnight':
                $main_colors['color_back_1'] = '#26292c';
                $main_colors['color_back_2'] = '#363b3f';
                $main_colors['color_back_top_level_hover'] = '#e14d43';
                $main_colors['color_back_top_level_active'] = '#e14d43';
                break;
            case 'ocean':
                $main_colors['color_back_1'] = '#627c83';
                $main_colors['color_back_2'] = '#738e96';
                $main_colors['color_back_top_level_hover'] = '#9ebaa0';
                $main_colors['color_back_top_level_active'] = '#9ebaa0';
                break;
            case 'sunrise':
                $main_colors['color_back_1'] = '#be3631';
                $main_colors['color_back_2'] = '#cf4944';
                $main_colors['color_back_top_level_hover'] = '#dd823b';
                $main_colors['color_back_top_level_active'] = '#dd823b';
                break;
            default:
                if (isset($colors['colors'])) {
                    $main_colors['color_back_1'] = (isset($colors['colors'][0])) ? $colors['colors'][0] : $main_colors['color_back_1'];
                    $main_colors['color_back_2'] = (isset($colors['colors'][1])) ? $colors['colors'][1] : $main_colors['color_back_2'];
                    $main_colors['color_back_top_level_hover'] = (isset($colors['colors'][2])) ? $colors['colors'][2] : $main_colors['color_accent_1'];
                    $main_colors['color_back_top_level_active'] = (isset($colors['colors'][2])) ? $colors['colors'][2] : $main_colors['color_accent_1'];
                }
        }// End switch().
        return $main_colors;
    }

}