<div class="zpwpcg-cart">

    <div class="zpwpcg-cart__header">
        <?php echo __( 'Main', TR_ID ); ?>
    </div>

    <div class="zpwpcg-cart__body">

        <h3>Name</h3>
        <?php $options->render_name(); ?>

        <div>
            <label for="points">
                <?php echo __('Vertical position', TR_ID); ?>
            </label>
            <div class="zpwpcg-el--flex">
                <input class="zpwpcg-range"
                       type="range"
                       id="points"
                       name="points"
                       oninput="this.nextElementSibling.value = this.value">
                <output>24</output><span>%</span>
            </div>
        </div>

        <h3>Text</h3>

        <?php $options->render_text(); ?>
    </div>
</div>