<?php
/**
 * @var ZPdevWPCG\Options $this
 */

use ZPdevWPCG\Controller;

?>

<div class="zpwpcg-cart">

    <div class="zpwpcg-cart__header">
        <?php
        echo __('Main', TR); ?>
    </div>

    <div class="zpwpcg-cart__body">

        <h3>Name</h3>
        
        <?php $this->render_input('label', __('Label for form field', TR), 'name'); ?>
        <?php $this->field_tuning('name', 40, true, 'center', 200, 'bold', ['max'=>400] ); ?>

        <h3>Text</h3>
        <?php
        
        $this->render_textarea('value', __('Before name text', TR), 'text_before');
        $this->field_tuning('text_before', true, true, 'center', 32, 700);
        
        $this->render_textarea('value', __('After name text', TR), 'text_after');
        $this->field_tuning('text_after', true, true, 'center', 32, 700);
        
        $this->render_textarea('value', __('After name strong text', TR), 'text_after_strong');
        $this->field_tuning('text_after_strong', true, true, 'center', 32, 700); ?>
    
        <?php submit_button(); ?>
    </div>
</div>