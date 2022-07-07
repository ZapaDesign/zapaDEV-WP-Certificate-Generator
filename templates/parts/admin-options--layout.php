<?php
    /**
     * @var ZPdevWPCG\Options $this
     */
    
    use ZPdevWPCG\Controller;
?>

<div class="zpwpcg-cart">
    <div class="zpwpcg-cart__header">
        <?php
            echo __( 'Layout', TR ); ?>
    </div>
    <div class="zpwpcg-cart__body">

        <?php
            $this->render_img( 'img', '/assets/img/certificate-template-demo.svg' );
        echo '<hr>';
        ( new Controller(
            [
                'type' => 'range',
                'field' => 'canvas',
                'param' => 'width',
                'label' => __('Width', TR),
                'args' => [
                    'max' => 10000
                ]
            ],
            [
                'type' => 'range',
                'field' => 'canvas',
                'param' => 'height',
                'label' => __('Height', TR),
                'args' => [
                    'max' => 10000
                ]
            ]
        ) )->render();

    
        submit_button(); ?>
    </div>
</div>
