<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php echo __( 'Layout', TR ); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <?php  $this->render_img( 'img', '/assets/img/certificate-template-demo.svg' ); ?>
        <hr>
        <button type="button" class="zpwpcg-tuning__btn--settings"><?php echo __('Settings', TR); ?></button>
        <div class="zpwpcg-tuning__body">
            <div class="zpwpcg-el--flex">
                <label for=""><?php echo __('Width', TR); ?></label>
                <input class="zpwpcg-range" type="number" value="2480">
            </div>
            <div  class="zpwpcg-el--flex">
                <label for=""><?php echo __('Height', TR); ?></label>
                <input class="zpwpcg-range" type="number" value="3508">
            </div>
        </div>
        <?php submit_button(); ?>
    </div>
</div>
