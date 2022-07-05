<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php
        echo __('Footer', TR); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <h3><?php echo __('Address', TR); ?></h3>
        <?php $this->render_textarea( 'value', __( 'Address', TR ), 'address' ); ?>
        <?php $this->field_tuning( 'address',true, true, false ); ?>
        <hr>
        <h3><?php echo __('Director', TR); ?></h3>
        <?php $this->render_input( 'label', __('Position', TR), 'director' ); ?>
        <?php $this->render_input( 'value', __('Name', TR), 'director' ); ?>
        <?php $this->field_tuning( 'director',true, true, false ); ?>
        <hr>
        <h3><?php echo __('Logo', TR); ?></h3>
        <?php $this->render_img( 'logo', '/assets/img/certificate-logo-demo.svg' ); ?>
        <?php $this->field_tuning( 'logo', true, true ); ?>
        <hr>
        <h3><?php echo __('Signature', TR); ?></h3>
        <?php $this->render_img( 'signature', '/assets/img/certificate-signature-demo.svg' ); ?>
        <?php $this->field_tuning( 'signature',true, true, false ); ?>

    </div>
</div>