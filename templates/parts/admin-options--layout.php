<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php echo __( 'Layout', TR_ID ); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <?php
        $options->render_img( array(
            'label_for' =>'img',
            'demo_link' => '/assets/img/certificate-template-demo.svg'
        ) ); ?>
    </div>
    <div class="zpwpcg-cart__footer zpwpcg-cart__footer--flex">
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
