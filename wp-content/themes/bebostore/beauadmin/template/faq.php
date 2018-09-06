<?php
/**
 * BeauAdmin
 * FAQ
 * @package BeauAdmin
 */
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
$content = [];
if(isset($this->config['faqs']['content'])) {
   $content = $this->config['faqs']['content'];
}

?>
<div class="wrap about-wrap beau-wrap">
	<?php $this->get_admin_screens_header( 'faqs' ); ?>
	   <?php if(isset($this->config['faqs']['notices'])) : ?>
        <div class="beau-important-notice">
            <?php echo sprintf('<div class="about-description">%s</div>',$this->config['faqs']['notices']);?>
        </div>
        <?php endif;?>
    <?php
    if (is_array($content) || is_object($content)) :
        foreach ($content as $k => $v) :
    ?>
	<div class="beau-admin-toggle">
        <?php if(isset($v['title'])) : ?>
		<div class="beau-admin-toggle-heading">
			<h3><?php echo wp_kses_post($v['title']); ?></h3>
			<span class="beau-admin-toggle-icon dashicons dashicons-plus"></span>
		</div>
        <?php endif;?>
        <?php if(isset($v['description'])) : ?>
		<div class="beau-admin-toggle-content">
            <?php echo wp_kses_post($v['description']); ?>
		</div>
        <?php endif;?>
	</div>
    <?php  endforeach; endif; ?>
	 <?php $this->get_admin_screens_footer(); ?>

</div>

<script type="text/javascript">
jQuery( '.beau-admin-toggle-heading' ).on( 'click', function() {
	jQuery( this ).parent().find( '.beau-admin-toggle-content' ).slideToggle( 300 );

	if ( jQuery( this ).find( '.beau-admin-toggle-icon' ).hasClass( 'dashicons-plus' ) ) {
		jQuery( this ).find( '.beau-admin-toggle-icon' ).removeClass( 'dashicons-plus' ).addClass( 'dashicons-minus' );
	} else {
		jQuery( this ).find( '.beau-admin-toggle-icon' ).removeClass( 'dashicons-minus' ).addClass( 'dashicons-plus' );
	}

});
</script>
