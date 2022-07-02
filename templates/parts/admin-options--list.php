<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php echo __( 'List', TR_ID ); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <h3><?php echo __( 'Course dates', TR_ID ); ?></h3>
        <?php $options->render_period(); ?>

        <h3><?php echo __( 'Level',TR_ID ); ?></h3>
        <?php $options->render_level(); ?>

        <h3><?php echo __( 'Number of hours', TR_ID ); ?></h3>
        <?php $options->render_hours(); ?>

        <h3><?php echo __( 'Location', TR_ID ); ?></h3>
        <?php $options->render_location(); ?>

        <h3><?php echo __( 'Date', TR_ID ); ?></h3>
        <?php $options->render_date(); ?>

    </div>
</div>
