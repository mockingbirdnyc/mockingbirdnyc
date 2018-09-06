<?php
/**
 * BeauAdmin
 * Support
 * @package BeauAdmin
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$content = [];
if(isset($this->config['support']['content'])) {
   $content = $this->config['support']['content'];
}
?>
<div class="wrap about-wrap beau-wrap">
    <?php $this->get_admin_screens_header( 'support' ); ?>
    <?php if(isset($this->config['support']['notices'])) : ?>
    <div class="beau-important-notice">
        <div class="about-description">
            <?php echo $this->config['support']['notices'];?>
        </div>
    </div>
    <?php endif;?>
    <div class="beau-support col three-col">
        <?php  if (is_array($content) || is_object($content)) :
                $i = 1;
                foreach ($content as $k => $v) :
                    $col = "col ";
                    if(($i%3) == 0) {
                        $col = "col last-feature last";
                    }
        ?>
            <div class="<?php echo esc_attr($col)?>">
                <?php if(isset($v['title'])) : ?>
                <h3><span class="<?php echo esc_attr($v['icon']); ?>"></span><?php echo esc_attr(wp_kses($v['title'],array())); ?></h3>
                <?php endif;?>
                <?php if(isset($v['description'])) : ?>
                <p><?php echo wp_kses_post($v['description']); ?></p>
                <?php endif;?>
                <?php if(isset($v['button_uri'])):?>
                    <a href="<?php echo esc_url($v['button_uri']);?>" class="button button-large button-primary " target="_blank" rel="noopener noreferrer"><?php echo wp_kses_post($v['button_title']);?></a>
                <?php endif ;?>
            </div>
        <?php  $i++; endforeach; endif; ?>
    </div>
</div>
