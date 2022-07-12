<?php
    /**
     * @var ZPdevWPCG\Options $this
     */
    
    use ZPdevWPCG\Controller;
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php
            echo __( 'Layout', TR ); ?>
    </div>
    <div class="zpwpcg-cart__body">

        <?php $this->render_img( 'img', '/assets/img/certificate-template-demo.svg' ); ?>
        <hr>
        <?php $this->canvas_tuning(true, true, [ 'max'=>10000, 'step'=>1 ] ); ?>
    
        <?php submit_button(); ?>
    </div>
</div>
