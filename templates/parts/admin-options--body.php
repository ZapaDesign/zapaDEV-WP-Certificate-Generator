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

        <?php $this->render_input( 'label', __('Name', TR), 'name' ); ?>
        <?php $this->field_tuning(
            'name',
            40,
            true,
            'center',
            200,
            'bold' ); ?>

        <h3>Text</h3>
        <?php $this->render_textarea( 'before', __('Before name text', TR), 'text' ); ?>
        <?php $this->field_tuning( 'before', true, true, true, 32, 'bold' ); ?>
        <?php $this->render_textarea( 'after', __('After name text', TR), 'text' ); ?>
        <?php $this->field_tuning( 'after',true, true, true, 32, 700 ); ?>
        <?php $this->render_textarea( 'after_strong', __('After name strong text', TR), 'text' ); ?>
        <?php $this->field_tuning( 'after_strong',true, true, true, 32, 700 ); ?>
    </div>
</div>