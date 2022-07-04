<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php echo __( 'List', TR ); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <h3><?php echo __( 'Course dates', TR ); ?></h3>
        <?php $this->render_input( 'label',__('Label on certificate', TR), 'period' ); ?>
        <?php $this->render_input( 'start', __('Form label', TR), 'period' ); ?>
        <?php $this->render_input( 'finish', __('Form label', TR), 'period' ); ?>
        <hr>
        <h3><?php echo __( 'Level',TR ); ?></h3>
        <?php $this->render_level(); ?>
        <hr>
        <h3><?php echo __( 'Number of hours', TR ); ?></h3>
        <?php $this->render_input( 'label', __('Label', TR), 'hours' ); ?>
        <?php $this->render_input( 'value', __('Default value', TR), 'hours' ); ?>
        <hr>
        <h3><?php echo __( 'Location', TR ); ?></h3>
        <?php $this->render_input( 'label', __('Label', TR), 'location' ); ?>
        <?php $this->render_input( 'value', __('Default value', TR), 'location' ); ?>
        <hr>
        <h3><?php echo __( 'Date', TR ); ?></h3>
        <?php $this->render_input( 'label', __('Label', TR), 'date' ); ?>
        <hr>
        <?php $this->field_tuning( 'list', true, true, false ); ?>
    </div>
</div>
