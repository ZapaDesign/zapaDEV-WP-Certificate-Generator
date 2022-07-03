<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php
        echo __('Footer', TR_ID); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <h3><?php echo __('Address', TR_ID); ?></h3>
        <?php $this->render_textarea( 'address', __( 'Address', TR_ID ) ); ?>

        <h3><?php echo __('Director', TR_ID); ?></h3>
        <?php $this->render_input( 'label', __('Position', TR_ID), 'director' ); ?>
        <?php $this->render_input( 'value', __('Name', TR_ID), 'director' ); ?>

        <h3><?php echo __('Logo', TR_ID); ?></h3>
        <?php $this->render_img( 'logo', '/assets/img/certificate-logo-demo.svg' ); ?>

        <h3><?php echo __('Signature', TR_ID); ?></h3>
        <?php $this->render_img( 'signature', '/assets/img/certificate-signature-demo.svg' ); ?>

    </div>
</div>