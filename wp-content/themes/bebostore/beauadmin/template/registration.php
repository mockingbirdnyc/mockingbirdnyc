<?php
/**
 * Registration Admin page.
 *
 * @package BeauAdmins
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<div class="wrap about-wrap beau-wrap">
    <?php $this->get_admin_screens_header( 'registration' ); ?>
    <div class="beau-important-notice">
        <p class="about-description">
            <?php echo sprintf(esc_html__('Thank you for choosing %s ! Your product must be registered to receive the %s Patcher and included premium plugins. The instructions below in toggle format must be followed exactly.','beauadmin'),BeauAdmin()->theme_name,BeauAdmin()->theme_name)?>
        </p>
    </div>
        <?php $this->init_registers->form();?>
    <?php $this->get_admin_screens_footer(); ?>
</div>
