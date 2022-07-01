<?php
    
    use function ZPdevWPCG\ZPdevWPCG;

?>

<div class="zpwpcg-adm__wrap">
    <h1 class="zpwpcg-adm__title"><?php
            
            echo __( 'Settings', TR_ID ) ?></h1>
    <p><?php
            echo __( 'List of saved certificates. You can edit, delete the certificate entry, and view or download the certificate.', TR_ID ); ?></p>

    <div class="zdcontainer">
        <div class="zdgrid zdgrid--x zdgrid--y">
            <div class="zdcell md-5 lg-4">
                <form method="post" action="options.php" enctype="multipart/form-data">
                    <?php
                        settings_fields( PREFIX . 'settings_option_group' );
                        $options = $GLOBALS['ZPdevWPCG_Options'];
                    ?>
                    
                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                             <?php echo __( 'Layout', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_img( array(
                                    'label_for' =>'img',
                                    'demo_link' => '/assets/img/certificate-template-demo.svg'
                                ) ); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php echo __( 'Name label', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_name(); ?>
                        </div>
                        
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php
                                echo __( 'Certificate Text', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_text(); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php
                                echo __( 'Course dates', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_period(); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php
                                echo __( 'Level',TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_level(); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php
                                echo __( 'Number of hours', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_hours(); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php
                                echo __( 'Location', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_location(); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php
                                echo __( 'Date', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_date(); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php
                                echo __( 'Address', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_address(); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php
                                echo __( 'Director', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_director(); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php echo __( 'Logo', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_img( array(
                                    'label_for' =>'logo',
                                    'demo_link' => '/assets/img/certificate-logo-demo.svg'
                                ) ); ?>
                        </div>
                    </div>

                    <div class="zpwpcg-cart">
                        <div class="zpwpcg-cart__header">
                            <?php echo __( 'Signature', TR_ID ); ?>
                        </div>
                        <div class="zpwpcg-cart__body">
                            <?php
                                $options->render_img( array(
                                    'label_for' =>'signature',
                                    'demo_link' => '/assets/img/certificate-signature-demo.svg'
                                ) ); ?>
                        </div>
                    </div>
                    
                    <?php
                        submit_button(); ?>
                </form>
            </div>

            <div class="zdcell md-7 lg-8">
                <div class="zpwpcg-canvas__wrap zpwpcg-adm-canvas__wrap">
                    <div class="zpwpcg-canvas__wrap">
                        <!--// TODO Добавить асинхронную загрузку изображений-->
                        <canvas
                            class="zpwpcg-canvas zpwpcg-adm-canvas"
                            id="zpwpcg-canvas"
                            data-imgsrc="<?php echo ZPdevWPCG()->plugin_url() . '/assets/img/certificate-template-demo.svg' ?>"
                            width="2480"
                            height="3508"
                        ></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--    <form method="post" action="options.php">
        <?php
        /*            // This prints out all hidden setting fields
                    settings_fields( PREFIX . 'settings_option_group' );
                    do_settings_sections( PREFIX . 'settings' );
                    submit_button();
                */ ?>
    </form>-->

    <!-- TODO (УДАЛИТЬ) var_dump zpdevwpcg_options - опции плагина в базе-->
    <!--    --><?php
        //        echo '<pre>';
        //        var_dump( get_option( PREFIX . 'option' ) );
        //        echo '</pre>';
        //    ?>
</div>