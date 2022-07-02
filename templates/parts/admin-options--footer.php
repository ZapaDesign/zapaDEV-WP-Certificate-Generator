<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php
        echo __('Footer', TR_ID); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <h3><?php echo __('Address', TR_ID); ?></h3>
        <?php $options->render_address(); ?>

        <h3><?php echo __('Director', TR_ID); ?></h3>
        <?php $options->render_director(); ?>

        <h3><?php echo __('Logo', TR_ID); ?></h3>
        <?php
        $options->render_img(array(
            'label_for' => 'logo',
            'demo_link' => '/assets/img/certificate-logo-demo.svg'
        )); ?>

        <h3><?php echo __('Signature', TR_ID); ?></h3>
        <?php
        $options->render_img(array(
            'label_for' => 'signature',
            'demo_link' => '/assets/img/certificate-signature-demo.svg'
        )); ?>

    </div>
</div>