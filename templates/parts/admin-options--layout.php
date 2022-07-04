<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php echo __( 'Layout', TR_ID ); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <?php  $this->render_img( 'img', '/assets/img/certificate-template-demo.svg' ); ?>
        <hr>
        <button type="button" class="zpwpcg-tuning__btn--settings"><?php echo __('Settings', TR_ID); ?></button>
        <div class="zpwpcg-tuning__body">
            <div class="zpwpcg-el--flex">
                <label for=""><?php echo __('Width', TR_ID); ?></label>
                <input class="zpwpcg-range" type="number" value="2480">
            </div>
            <div  class="zpwpcg-el--flex">
                <label for=""><?php echo __('Height', TR_ID); ?></label>
                <input class="zpwpcg-range" type="number" value="3508">
            </div>
        </div>
    </div>
</div>
