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
            <div class="zpwpcg-el--flex">
                <label for=""><?php echo __('Width', TR); ?></label>
                <input
                    class="zpwpcg-tuning__field zpwpcg-tuning__field--canvas-width"
                    type="range"
                    step="1"
                    max="10000"
                    id="zpdevwpcg_canvas_width"
                    name="zpdevwpcg_option[canvas][width]"
                    value="<?php echo isset($this->options['canvas']['width']) ? esc_attr($this->options['canvas']['width']) : 2480; ?>"
                >
                <output><?php echo isset($this->options['canvas']['width']) ? esc_attr($this->options['canvas']['width']) : 2480; ?></output>
            </div>
            <div  class="zpwpcg-el--flex">
                <label for=""><?php echo __('Height', TR); ?></label>
                <input
                    class="zpwpcg-tuning__field zpwpcg-tuning__field--canvas-height"
                    type="range"
                    step="1"
                    max="10000"
                    id="zpdevwpcg_canvas_height"
                    name="zpdevwpcg_option[canvas][height]"
                    value="<?php echo isset($this->options['canvas']['height']) ? esc_attr($this->options['canvas']['height']) : 3508; ?>"
                >
                <output><?php echo isset($this->options['canvas']['height']) ? esc_attr($this->options['canvas']['height']) : 3508; ?></output>
            </div>
        </div>
        <?php submit_button(); ?>
    </div>
</div>
