<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">

    <div class="zpwpcg-cart__header">
        <?php echo __('Main', TR); ?>
    </div>

    <div class="zpwpcg-cart__body">

        <h3>Name</h3>

        <?php $this->render_input( 'label', __('Label for form field', TR), 'name' ); ?>
        <?php $this->field_tuning(
            'name',
            40,
            true,
            'center',
            200,
            'bold' ); ?>

        <h3>Text</h3>
        <?php $this->render_textarea( 'value', __('Before name text', TR), 'text_before' ); ?>
        <?php $this->field_tuning( 'text_before', true, true, 'center', 32, 'bold' ); ?>
        <?php $this->render_textarea( 'value', __('After name text', TR), 'text_after' ); ?>
        <?php $this->field_tuning( 'text_after',true, true, 'center', 32, 700 ); ?>
        <?php $this->render_textarea( 'value', __('After name strong text', TR), 'text_after_strong' ); ?>
        <?php $this->field_tuning( 'text_after_strong',true, true, 'center', 32, 700 ); ?>
    </div>
</div>