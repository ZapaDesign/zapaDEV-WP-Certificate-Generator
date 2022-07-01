<?php
    use function ZPdevWPCG\ZPdevWPCG;
    ?>

<div class="zpwpcg-adm__wrap">
    <h1 class="zpwpcg-adm__title"><?php
        
            echo __( 'Settings', TR_ID ) ?></h1>
    <p><?php echo __('List of saved certificates. You can edit, delete the certificate entry, and view or download the certificate.', TR_ID); ?></p>

    <div class="zdcontainer">
    <div class="zdgrid zdgrid--x zdgrid--y">
        <div class="zdcell md-4">
            <form method="post" action="options.php" enctype="multipart/form-data">
                <?php
                    settings_fields(PREFIX.'settings_option_group');
                    $options = $GLOBALS['ZPdevWPCG_Options'];
                ?>

                        <div class="zpwpcg-cart">
                            <div class="zpwpcg-cart__header">
                                Layout
                            </div>
                            <div class="zpwpcg-cart__body">
                                <?php $options->render_img('img'); ?>
                            </div>
                        </div>

                        <div class="zpwpcg-cart">
                            <div class="zpwpcg-cart__header">
                                <?php echo __('Field (Name label)', TR_ID); ?>
                            </div>
                            <div class="zpwpcg-cart__body">
                                <?php $options->render_name(); ?>
                            </div>
                        </div>

                        <div class="zpwpcg-cart">
                            <div class="zpwpcg-cart__header">
                                <?php echo __('Field (Text)', TR_ID); ?>
                            </div>
                            <div class="zpwpcg-cart__body">
                                <?php $options->render_text(); ?>
                            </div>
                        </div>

                        <div class="zpwpcg-cart">
                            <div class="zpwpcg-cart__header">
                                <?php echo __('Field (Course dates)'); ?>
                            </div>
                            <div class="zpwpcg-cart__body">
                                <?php $options->render_period(); ?>
                            </div>
                        </div>

                        <div class="zpwpcg-cart">
                            <div class="zpwpcg-cart__header">
                                <?php echo __('Field (Level)'); ?>
                            </div>
                            <div class="zpwpcg-cart__body">
                                <?php $options->render_level(); ?>
                            </div>
                        </div>
        
                <?php submit_button(); ?>
            </form>
        </div>
        
        <div class="zdcell md-8">
            <div class="zpwpcg-canvas__wrap zpwpcg-adm-canvas__wrap">
                <img class="zpwpcg-canvas zpwpcg-adm-canvas" src="<?php echo ZPdevWPCG()->plugin_url().'/assets/img/certificate-template-demo.svg' ?>" alt="">
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
        */?>
    </form>-->
    
    <!-- TODO (УДАЛИТЬ) var_dump zpdevwpcg_options - опции плагина в базе-->
<!--    --><?php
//        echo '<pre>';
//        var_dump( get_option( PREFIX . 'option' ) );
//        echo '</pre>';
//    ?>
</div>