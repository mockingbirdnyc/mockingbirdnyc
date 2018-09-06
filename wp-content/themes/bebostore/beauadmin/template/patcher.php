<?php
/**
 * Patcher Admin page.
 *
 * @package BeauAdmins
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

?>
<div class="wrap about-wrap beau-wrap">
    <?php $this->get_admin_screens_header( 'patcher' ); ?>
    <div class="feature-section beau-patcher">
        <?php $this->patcher->form();?>
    </div>
      <?php $this->get_admin_screens_footer(); ?>

</div>
