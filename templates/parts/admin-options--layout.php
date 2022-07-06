<?php
/**
 * @var ZPdevWPCG\Options $this
 */
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php echo __( 'Layout', TR ); ?>
    </div>
    <div class="zpwpcg-cart__body">
        <?php  $this->render_img( 'img', '/assets/img/certificate-template-demo.svg' ); ?>
        <hr>
        <button type="button" class="zpwpcg-tuning__btn--settings"><?php echo __('Settings', TR); ?></button>
        <div class="zpwpcg-tuning__body">
            
            <div class="zpwpcg-controller--range" data-param="canvas-width">
                <label for="">
                    <?php echo __('Width', TR); ?>
                </label>
                <input
                    class="zpwpcg-tuning__field zpwpcg-controller--range__range"
                    type="range"
                    step="1"
                    max="10000"
                    name="zpdevwpcg_option[canvas][width]"
                    value="<?php echo isset($this->options['canvas']['width']) ? esc_attr($this->options['canvas']['width']) : 2480; ?>"
                >
                <input
                    class="zpwpcg-tuning__field zpwpcg-controller--range__input"
                    type="number"
                    name="zpdevwpcg_option[canvas][width]"
                    value="<?php echo isset($this->options['canvas']['width']) ? esc_attr($this->options['canvas']['width']) : 2480; ?>"
                >
            </div>
            
            <div class="zpwpcg-controller--range" data-param="canvas-height">
                <label for=""><?php echo __('Height', TR); ?></label>
                <input
                    class="zpwpcg-tuning__field zpwpcg-controller--range__range"
                    type="range"
                    step="1"
                    max="10000"
                    name="zpdevwpcg_option[canvas][height]"
                    value="<?php echo isset($this->options['canvas']['height']) ? esc_attr($this->options['canvas']['height']) : 3508; ?>"
                >
                <input
                    id="zpdevwpcg_canvas_height"
                    class="zpwpcg-tuning__field zpwpcg-controller--range__input"
                    type="number"
                    value="<?php echo isset($this->options['canvas']['height']) ? esc_attr($this->options['canvas']['height']) : 3508; ?>"
                >
            </div>
        </div>
        <?php submit_button(); ?>
    </div>
</div>
