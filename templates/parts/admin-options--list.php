<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php echo __( 'List', TR_ID ); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <h3><?php echo __( 'Course dates', TR_ID ); ?></h3>
        <?php $this->render_input( 'label',__('Label on certificate', TR_ID), 'period' ); ?>
        <?php $this->render_input( 'start', __('Form label', TR_ID), 'period' ); ?>
        <?php $this->render_input( 'finish', __('Form label', TR_ID), 'period' ); ?>
        <hr>
        <h3><?php echo __( 'Level',TR_ID ); ?></h3>
        <?php $this->render_level(); ?>
        <hr>
        <h3><?php echo __( 'Number of hours', TR_ID ); ?></h3>
        <?php $this->render_input( 'label', __('Label', TR_ID), 'hours' ); ?>
        <?php $this->render_input( 'value', __('Default value', TR_ID), 'hours' ); ?>
        <hr>
        <h3><?php echo __( 'Location', TR_ID ); ?></h3>
        <?php $this->render_input( 'label', __('Label', TR_ID), 'location' ); ?>
        <?php $this->render_input( 'value', __('Default value', TR_ID), 'location' ); ?>
        <hr>
        <h3><?php echo __( 'Date', TR_ID ); ?></h3>
        <?php $this->render_input( 'label', __('Label', TR_ID), 'date' ); ?>
        <hr>
        <?php $this->field_tuning( true, true, false ); ?>
    </div>
</div>
