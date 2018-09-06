<?php
/**
 * BeauAdmin
 * Systems
 * @package BeauAdmin
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="wrap about-wrap beau-wrap">
    <?php $this->get_admin_screens_header( 'systems' ); ?>
    <div class="beau-systems">
        <h3 class="screen-reader-text"><?php esc_attr_e( 'Theme Versions', 'beauadmin' ); ?></h3>
        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3" data-export-label="Theme Versions"><?php esc_attr_e( 'Theme Versions', 'beauadmin' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-export-label="Current Version"><?php esc_attr_e( 'Current Version:', 'beauadmin' ); ?></td>
                    <td class="help">&nbsp;</td>
                    <td><?php echo esc_attr( $this->theme_version ); ?></td>
                </tr>
                <?php if(isset($this->config['version']) && ($this->config['version'] != $this->theme_version ) ): ?>
                <tr>
                    <td data-export-label="Available Version"><b><?php esc_attr_e( 'Available Version:', 'beauadmin' ); ?></b></td>
                    <td class="help">&nbsp;</td>
                    <td><b><?php echo $this->config['version'];?></b></td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>

        <h3 class="screen-reader-text"><?php esc_attr_e( 'WordPress Environment', 'beauadmin' ); ?></h3>
        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3" data-export-label="WordPress Environment"><?php esc_attr_e( 'WordPress Environment', 'beauadmin' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-export-label="Home URL"><?php esc_attr_e( 'Home URL:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The URL of your site\'s homepage.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td><?php echo esc_url_raw( home_url() ); ?></td>
                </tr>
                <tr>
                    <td data-export-label="Site URL"><?php esc_attr_e( 'Site URL:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The root URL of your site.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td><?php echo esc_url_raw( site_url() ); ?></td>
                </tr>
                <tr>
                    <td data-export-label="WP Version"><?php esc_attr_e( 'WP Version:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of WordPress installed on your site.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td><?php bloginfo( 'version' ); ?></td>
                </tr>
                <tr>
                    <td data-export-label="WP Multisite"><?php esc_attr_e( 'WP Multisite:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Whether or not you have WordPress Multisite enabled.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td><?php echo ( is_multisite() ) ? '<mark class="yes">&#10004;</mark>' : '&ndash;'; ?></td>
                </tr>
                <tr>
                    <td data-export-label="PHP Memory Limit"><?php esc_attr_e( 'PHP Memory Limit:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum amount of memory (RAM) that your site can use at one time.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td>
                        <?php
                        // Get the memory from PHP's configuration.
                        $memory = ini_get( 'memory_limit' );
                        // If we can't get it, fallback to WP_MEMORY_LIMIT.
                        if ( ! $memory || -1 === $memory ) {
                            $memory = wp_convert_hr_to_bytes( WP_MEMORY_LIMIT );
                        }
                        // Make sure the value is properly formatted in bytes.
                        if ( ! is_numeric( $memory ) ) {
                            $memory = wp_convert_hr_to_bytes( $memory );
                        }
                        ?>
                        <?php if ( $memory < 128000000 ) : ?>
                            <mark class="error">
                                <?php echo wp_kses_post( printf( __( '%1$s - We recommend setting memory to at least <strong>128MB</strong>. <br /> To import classic demo data, <strong>256MB</strong> of memory limit is required. <br /> Please define memory limit in <strong>wp-config.php</strong> file. To learn how, see: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing memory allocated to PHP.</a>', 'beauadmin' ), esc_attr( size_format( $memory ) ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) ); ?>
                            </mark>
                        <?php else : ?>
                            <mark class="yes">
                                <?php echo esc_attr( size_format( $memory ) ); ?>
                            </mark>
                            <?php if ( $memory < 256000000 ) : ?>
                                <br />
                                <mark class="error">
                                    <?php printf( esc_attr__( 'Your current memory limit is sufficient, but if you need to import classic demo content, the required memory limit is %s', 'beauadmin' ), '<strong>256MB.</strong>' ); ?>
                                </mark>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td data-export-label="WP Debug Mode"><?php esc_attr_e( 'WP Debug Mode:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Displays whether or not WordPress is in Debug Mode.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td>
                        <?php if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) : ?>
                            <mark class="yes">&#10004;</mark>
                        <?php else : ?>
                            <mark class="no">&ndash;</mark>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td data-export-label="Language"><?php esc_attr_e( 'Language:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The current language used by WordPress. Default = English', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td><?php echo esc_attr( get_locale() ) ?></td>
                </tr>
            </tbody>
        </table>

        <h3 class="screen-reader-text"><?php esc_attr_e( 'Server Environment', 'beauadmin' ); ?></h3>
        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="3" data-export-label="Server Environment"><?php esc_attr_e( 'Server Environment', 'beauadmin' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-export-label="Server Info"><?php esc_attr_e( 'Server Info:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Information about the web server that is currently hosting your site.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td><?php echo isset( $_SERVER['SERVER_SOFTWARE'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) ) : esc_attr__( 'Unknown', 'beauadmin' ); ?></td>
                </tr>
                <tr>
                    <td data-export-label="PHP Version"><?php esc_attr_e( 'PHP Version:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of PHP installed on your hosting server.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td>
                        <?php
                        $php_version = null;
                        if ( defined( 'PHP_VERSION' ) ) {
                            $php_version = PHP_VERSION;
                        } elseif ( function_exists( 'phpversion' ) ) {
                            $php_version = phpversion();
                        }
                        if ( null === $php_version ) {
                            $message = esc_attr__( 'PHP Version could not be detected.', 'beauadmin' );
                        } else {
                            if ( version_compare( $php_version, '7.0.0' ) >= 0 ) {
                                $message = $php_version;
                            } else {
                                $message = sprintf( esc_attr__( '%1$s. WordPress recomendation: 7.0.0 or above. See %2$s for details.', 'beauadmin' ), $php_version, '<a href="https://wordpress.org/about/requirements/" target="_blank">WordPress Requirements</a>' );
                            }
                        }
                        echo wp_kses_post( $message );
                        ?>
                    </td>
                </tr>
                <?php if ( function_exists( 'ini_get' ) ) : ?>
                    <tr>
                        <td data-export-label="PHP Post Max Size"><?php esc_attr_e( 'PHP Post Max Size:', 'beauadmin' ); ?></td>
                        <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest file size that can be contained in one post.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                        <td><?php echo esc_attr( size_format( wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) ) ) ); ?></td>
                    </tr>
                    <tr>
                        <td data-export-label="PHP Time Limit"><?php esc_attr_e( 'PHP Time Limit:', 'beauadmin' ); ?></td>
                        <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'beauadmin' ) . '">[?]</a>'; ?></td>
                        <td>
                            <?php
                            $time_limit = ini_get( 'max_execution_time' );

                            if ( 180 > $time_limit && 0 != $time_limit ) {
                                echo wp_kses_post( '<mark class="error">' . sprintf( __( '%1$s - We recommend setting max execution time to at least 180. <br /> To import classic demo content, <strong>300</strong> seconds of max execution time is required.<br />See: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing max execution to PHP</a>', 'beauadmin' ), $time_limit, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' ) . '</mark>' );
                            } else {
                                echo '<mark class="yes">' . esc_attr( $time_limit ) . '</mark>';
                                if ( 300 > $time_limit && 0 != $time_limit ) {
                                    echo wp_kses_post( '<br /><mark class="error">' . __( 'Current time limit is sufficient, but if you need import classic demo content, the required time is <strong>300</strong>.', 'beauadmin' ) . '</mark>' );
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td data-export-label="PHP Max Input Vars"><?php esc_attr_e( 'PHP Max Input Vars:', 'beauadmin' ); ?></td>
                        <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                        <?php
                        $registered_navs = get_nav_menu_locations();
                        $menu_items_count = array(
                            '0' => '0',
                        );
                        foreach ( $registered_navs as $handle => $registered_nav ) {
                            $menu = wp_get_nav_menu_object( $registered_nav );
                            if ( $menu ) {
                                $menu_items_count[] = $menu->count;
                            }
                        }

                        $max_items = max( $menu_items_count );
                        $required_input_vars = $max_items * 12;
                        ?>
                        <td>
                            <?php
                            $max_input_vars = ini_get( 'max_input_vars' );
                            $required_input_vars = $required_input_vars + ( 500 + 1000 );
                            // 1000 = theme options
                            if ( $max_input_vars < $required_input_vars ) {
                                echo wp_kses_post( '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'beauadmin' ), $max_input_vars, '<strong>' . $required_input_vars . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>' );
                            } else {
                                echo '<mark class="yes">' . esc_attr( $max_input_vars ) . '</mark>';
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td data-export-label="SUHOSIN Installed"><?php esc_attr_e( 'SUHOSIN Installed:', 'beauadmin' ); ?></td>
                        <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself.
        If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', 'beauadmin'  ) . '">[?]</a>'; ?></td>
                        <td><?php echo extension_loaded( 'suhosin' ) ? '&#10004;' : '&ndash;'; ?></td>
                    </tr>
                    <?php if ( extension_loaded( 'suhosin' ) ) :  ?>
                        <tr>
                            <td data-export-label="Suhosin Post Max Vars"><?php esc_attr_e( 'Suhosin Post Max Vars:', 'beauadmin' ); ?></td>
                            <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                            <?php
                            $registered_navs = get_nav_menu_locations();
                            $menu_items_count = array(
                                '0' => '0',
                            );
                            foreach ( $registered_navs as $handle => $registered_nav ) {
                                $menu = wp_get_nav_menu_object( $registered_nav );
                                if ( $menu ) {
                                    $menu_items_count[] = $menu->count;
                                }
                            }

                            $max_items = max( $menu_items_count );

                            ?>
                            <td>
                                <?php
                                $max_input_vars = ini_get( 'suhosin.post.max_vars' );
                                $required_input_vars = $required_input_vars + ( 500 + 1000 );

                                if ( $max_input_vars < $required_input_vars ) {
                                    echo wp_kses_post( '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'beauadmin' ), $max_input_vars, '<strong>' . ( $required_input_vars ) . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>' );
                                } else {
                                    echo '<mark class="yes">' . esc_attr( $max_input_vars ) . '</mark>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td data-export-label="Suhosin Request Max Vars"><?php esc_attr_e( 'Suhosin Request Max Vars:', 'beauadmin' ); ?></td>
                            <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                            <?php
                            $registered_navs = get_nav_menu_locations();
                            $menu_items_count = array(
                                '0' => '0',
                            );
                            foreach ( $registered_navs as $handle => $registered_nav ) {
                                $menu = wp_get_nav_menu_object( $registered_nav );
                                if ( $menu ) {
                                    $menu_items_count[] = $menu->count;
                                }
                            }

                            $max_items = max( $menu_items_count );

                            ?>
                            <td>
                                <?php
                                $max_input_vars = ini_get( 'suhosin.request.max_vars' );
                                $required_input_vars = $required_input_vars + ( 500 + 1000 );

                                if ( $max_input_vars < $required_input_vars ) {
                                    echo wp_kses_post( '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'beauadmin' ), $max_input_vars, '<strong>' . ( $required_input_vars + ( 500 + 1000 ) ) . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>' );
                                } else {
                                    echo '<mark class="yes">' . esc_attr( $max_input_vars ) . '</mark>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td data-export-label="Suhosin Post Max Value Length"><?php esc_attr_e( 'Suhosin Post Max Value Length:', 'beauadmin' ); ?></td>
                            <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Defines the maximum length of a variable that is registered through a POST request.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                            <td><?php
                                $suhosin_max_value_length = ini_get( 'suhosin.post.max_value_length' );
                                $recommended_max_value_length = 2000000;

                            if ( $suhosin_max_value_length < $recommended_max_value_length ) {
                                echo wp_kses_post( '<mark class="error">' . sprintf( __( '%1$s - Recommended Value: %2$s.<br />Post Max Value Length limitation may prohibit the Theme Options data from being saved to your database. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Suhosin Configuration Info</a>.', 'beauadmin' ), $suhosin_max_value_length, '<strong>' . $recommended_max_value_length . '</strong>', 'http://suhosin.org/stories/configuration.html' ) . '</mark>' );
                            } else {
                                echo '<mark class="yes">' . esc_attr( $suhosin_max_value_length ) . '</mark>';
                            }
                            ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
                <tr>
                    <td data-export-label="ZipArchive"><?php esc_attr_e( 'ZipArchive:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td><?php echo class_exists( 'ZipArchive' ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">ZipArchive is not installed on your server, but is required if you need to import demo content.</mark>'; ?></td>
                </tr>
                <tr>
                    <td data-export-label="MySQL Version"><?php esc_attr_e( 'MySQL Version:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of MySQL installed on your hosting server.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td>
                        <?php global $wpdb; ?>
                        <?php echo esc_attr( $wpdb->db_version() ); ?>
                    </td>
                </tr>
                <tr>
                    <td data-export-label="Max Upload Size"><?php esc_attr_e( 'Max Upload Size:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest file size that can be uploaded to your WordPress installation.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td><?php echo esc_attr( size_format( wp_max_upload_size() ) ); ?></td>
                </tr>
                <tr>
                    <td data-export-label="WP Remote Get"><?php esc_attr_e( 'WP Remote Get:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'beauadmin uses this method to communicate with different APIs, e.g. Google, Twitter, Facebook.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <?php $response = wp_safe_remote_get( 'https://build.envato.com/api/', array(
                        'decompress' => false,
                        'user-agent' => 'beauadmin-remote-get-test',
                    ) ); ?>
                    <td><?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">wp_remote_get() failed. Some theme features may not work. Please contact your hosting provider and make sure that https://build.envato.com/api/ is not blocked.</mark>'; ?></td>
                </tr>
                <tr>
                    <td data-export-label="WP Remote Post"><?php esc_attr_e( 'WP Remote Post:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'beauadmin uses this method to communicate with different APIs, e.g. Google, Twitter, Facebook.', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <?php $response = wp_safe_remote_post( 'https://envato.com/', array(
                        'decompress' => false,
                        'user-agent' => 'beauadmin-remote-get-test',
                    ) ); ?>
                    <td><?php echo ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">wp_remote_post() failed. Some theme features may not work. Please contact your hosting provider and make sure that https://envato.com/ is not blocked.</mark>'; ?></td>
                </tr>
                <tr>
                    <td data-export-label="GD Library"><?php esc_attr_e( 'GD Library:', 'beauadmin' ); ?></td>
                    <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'beauadmin uses this library to resize images and speed up your site\'s loading time', 'beauadmin' ) . '">[?]</a>'; ?></td>
                    <td>
                        <?php
                        $info = esc_attr__( 'Not Installed', 'beauadmin' );
                        if ( extension_loaded( 'gd' ) && function_exists( 'gd_info' ) ) {
                            $info = esc_attr__( 'Installed', 'beauadmin' );
                            $gd_info = gd_info();
                            if ( isset( $gd_info['GD Version'] ) ) {
                                $info = $gd_info['GD Version'];
                            }
                        }
                        echo esc_attr( $info );
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3 class="screen-reader-text"><?php esc_attr_e( 'Active Plugins', 'beauadmin' ); ?></h3>
        <table class="widefat" cellspacing="0" id="status">
            <thead>
                <tr>
                    <th colspan="3" data-export-label="Active Plugins (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)"><?php esc_attr_e( 'Active Plugins', 'beauadmin' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $active_plugins = (array) get_option( 'active_plugins', array() );

                if ( is_multisite() ) {
                    $active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
                }

                foreach ( $active_plugins as $plugin ) {

                    $plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
                    $dirname        = dirname( $plugin );
                    $version_string = '';
                    $network_string = '';

                    if ( ! empty( $plugin_data['Name'] ) ) {

                        // Link the plugin name to the plugin url if available.
                        if ( ! empty( $plugin_data['PluginURI'] ) ) {
                            $plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . __( 'Visit plugin homepage' , 'beauadmin' ) . '">' . esc_html( $plugin_data['Name'] ) . '</a>';
                        }
                        ?>
                        <tr>
                            <td><?php echo wp_kses_post( $plugin_name ); ?></td>
                            <td class="help">&nbsp;</td>
                            <td><?php echo wp_kses_post( sprintf( esc_attr__( 'by %s', 'beauadmin' ), '<a href="' . esc_url( $plugin_data['AuthorURI'] ) . '" target="_blank">' . esc_html( $plugin_data['AuthorName'] ) . '</a>' ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string ); ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>