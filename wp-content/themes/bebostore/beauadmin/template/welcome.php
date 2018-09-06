<?php
/**
 * BeauAdmin
 * Welcome
 * @package BeauAdmin
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$content = $this->config['welcome']['content'];
?>
<div class="wrap about-wrap beau-wrap">
    <?php $this->get_admin_screens_header( 'welcome' ); ?>
    <div class="welcome-tour">
        <?php if(isset($this->config['welcome']['video']) != NULL) :?>
            <div class="welcome-video" data-video="beau-welcome" data-uri="<?php echo $this->config['welcome']['video']; ?>" width="1120" height="630"></div>
    <?php endif ?>
    <?php  if (is_array($content) || is_object($content)) : ?>
        <div class="col three-col">
            <?php
                $i = 1;
                foreach ($content as $k => $v) :
                    $col = "col ";
                    if(($i%3) == 0) {
                        $col = "col last-feature last";
                    }
        ?>
            <div class="<?php echo esc_attr($col)?>">
                <h3><?php echo wp_kses_post($v['title']); ?></h3>
                <p><?php echo wp_kses_post($v['description']); ?></p>
            </div>
        <?php  $i++; endforeach; ?>
        </div>
        <?php else: ?>
            <div class="welcome-tour-content">
                <?php echo wp_kses_post($content);?>
            </div>
        <?php endif;?>

    </div>
    <?php $this->get_admin_screens_footer(); ?>

</div>