<?php
    /**
     * @var ZPdevWPCG\Options $this
     */
    use function ZPdevWPCG\ZPdevWPCG;

?>

<div class="zpwpcg-adm__wrap">
    <h1 class="zpwpcg-adm__title"><?php echo __('Settings', TR) ?></h1>
    <p><?php echo __('List of saved certificates. You can edit, delete the certificate entry, and view or download the certificate.', TR); ?></p>

    <div class="zdcontainer">
        <div class="zdgrid zdgrid--x zdgrid--y">
            <div class="zdcell md-6">
                <form method="post" action="options.php" enctype="multipart/form-data">
                    <?php settings_fields(PREFIX . 'settings_option_group'); ?>

                        <div class="zdgrid">
                            <div class="zdcell lg-6">
                                <?php include_once(DIR_PATH . 'templates/parts/admin-options--layout.php'); ?>
                            </div>
                            <div class="zdcell lg-6">
                                <?php include_once(DIR_PATH . 'templates/parts/admin-options--body.php'); ?>
                            </div>
                            <div class="zdcell lg-6">
                                <?php include_once(DIR_PATH . 'templates/parts/admin-options--list.php'); ?>
                            </div>
                            <div class="zdcell lg-6">
                                <?php include_once(DIR_PATH . 'templates/parts/admin-options--footer.php'); ?>
                            </div>
                        </div>

                    <?php submit_button(); ?>
                </form>
            </div>

            <div class="zdcell md-6">
                <div class="zpwpcg-canvas__wrap zpwpcg-adm-canvas__wrap">
                    <div class="zpwpcg-canvas__wrap zpwpcg-adm-canvas__wrap">
                        <!--// TODO Добавить асинхронную загрузку изображений-->
                        
                            <canvas
                                class="zpwpcg-canvas zpwpcg-adm-canvas"
                                id="zpwpcg-adm-canvas"
                                data-imgsrc="<?php echo ZPdevWPCG()->plugin_url() . '/assets/img/certificate-template-demo.svg' ?>"
                                width="<?php echo $this->options['canvas']['width']; ?>"
                                height="<?php echo $this->options['canvas']['height'];  ?>"
                            ></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>