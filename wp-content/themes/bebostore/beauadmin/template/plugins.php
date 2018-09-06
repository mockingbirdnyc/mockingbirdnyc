<?php
/**
 * Plugins
 * @package beauadmin
 * @subpackage BeauCore_AdminScreen
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$plugins           = TGM_Plugin_Activation::$instance->plugins;
$installed_plugins = get_plugins();
?>
<div class="wrap about-wrap beau-wrap">
    <?php $this->get_admin_screens_header( 'plugins' ); ?>
    <?php if(isset($this->bundled_plugins['notices'])) : ?>
    <div class="beau-important-notice">
        <?php echo sprintf('<div class="about-description">%s</div>',$this->bundled_plugins['notices']);?>
    </div>
    <?php endif?>
    <div id="the-list" class="beau-plugins-list">
        <?php foreach ( $plugins as $plugin ) :
            $class = '';
            $plugin_status = '';
            $file_path = $plugin['file_path'];
            $plugin_action = $this->plugin_link( $plugin );

            // We have a repo plugin.
            if ( ! $plugin['version'] ) {
                $plugin['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $plugin['slug'] );
            }

            if ( is_plugin_active( $file_path ) ) {
                $plugin_status = 'active';
                $class = 'active';
            }
        ?>
        <div class="plugin-card plugin-card-<?php echo esc_attr($plugin['slug'])?>">
            <div class="plugin-card-top">
                <?php if ( isset( $plugin['required'] ) && $plugin['required'] ) : ?>
                    <div class="plugin-required">
                        <?php esc_html_e( 'Required', 'beauadmin' ); ?>
                    </div>
                <?php endif; ?>

                <div class="name column-name">
                    <h3>
                        <?php echo esc_attr( $plugin['name'] ); ?>
                        <?php if(isset($plugin['image_url']) != '') :?>
                        <img src="<?php echo esc_url_raw( $plugin['image_url'] ); ?>" class="plugin-icon bundled" alt="" />
                        <?php else : ?>
                         <img src="https://ps.w.org/<?php echo esc_attr($plugin['slug'])?>/assets/icon-128x128.png" class="plugin-icon" alt="">
                        <?php endif; ?>

                    </h3>
                </div>

                <div class="desc column-description">

                    <?php if ( isset( $installed_plugins[ $plugin['file_path'] ] ) ) : ?>
                        <p><?php echo wp_trim_words($installed_plugins[ $plugin['file_path'] ]['Description'], 15, '...' );?></p>
                        <?php echo wp_kses_post( sprintf( __( '<p class="authors">Version: %1$s | <a href="%2$s" target="_blank">%3$s</a></p>', 'beauadmin' ), esc_attr( $installed_plugins[ $plugin['file_path'] ]['Version'] ), esc_url_raw( $installed_plugins[ $plugin['file_path'] ]['AuthorURI'] ), esc_attr( $installed_plugins[ $plugin['file_path'] ]['Author'] ) ) ); ?>
                    <?php elseif ( 'repo' != $plugin['source_type'] ) : ?>
                        <?php printf( esc_attr__( 'Available Version: %s', 'beauadmin' ), esc_attr( $plugin['version'] ) ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="plugin-card-bottom <?php echo esc_attr($class)?>">
                <div class="plugin-action">
                    <?php foreach ( $plugin_action as $action ) : echo $action; endforeach; ?>
                </div>
                <?php if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) : ?>
                    <div class="update-message notice inline notice-warning notice-alt">
                        <p><?php printf( esc_attr__( 'New Version Available: %s', 'beauadmin' ), esc_attr( $plugin['version'] ) ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
     <?php $this->get_admin_screens_footer(); ?>


</div>