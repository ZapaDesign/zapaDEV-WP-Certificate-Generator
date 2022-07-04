<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">

    <div class="zpwpcg-cart__header">
        <?php echo __('Main', TR_ID); ?>
    </div>

    <div class="zpwpcg-cart__body">

        <h3>Name</h3>

        <?php $this->render_input( 'label', __('Name', TR_ID), 'name' ); ?>
        <?php $this->field_tuning( true, true, true, 32, 700 ); ?>

        <h3>Text</h3>
        <?php $this->render_textarea( 'before', __('Before name text', TR_ID), 'text' ); ?>
        <?php $this->field_tuning( true, true, true, 32, 700 ); ?>
        <?php $this->render_textarea( 'after', __('After name text', TR_ID), 'text' ); ?>
        <?php $this->field_tuning( true, true, true, 32, 700 ); ?>
        <?php $this->render_textarea( 'after_strong', __('After name strong text', TR_ID), 'text' ); ?>
        <?php $this->field_tuning( true, true, true, 32, 700 ); ?>
    </div>
</div>