<?php

use function ZPdevWPCG\ZPdevWPCG;

?>

<div class="zpwpcg-adm__wrap">
    <h1 class="zpwpcg-adm__title"><?php echo __('Settings', TR) ?></h1>
    <p><?php echo __('List of saved certificates. You can edit, delete the certificate entry, and view or download the certificate.', TR); ?></p>

    <div class="zdcontainer">
        <div class="zdgrid zdgrid--x zdgrid--y">
            <div class="zdcell md-5 lg-4">
                <form method="post" action="options.php" enctype="multipart/form-data">
                    <?php
                        
                        echo '<pre>';
                        var_dump($this);
                        echo '</pre>';
                        
                    settings_fields(PREFIX . 'settings_option_group');
                    include_once(DIR_PATH . 'templates/parts/admin-options--layout.php');
                    include_once(DIR_PATH . 'templates/parts/admin-options--body.php');
                    include_once(DIR_PATH . 'templates/parts/admin-options--list.php');
                    include_once(DIR_PATH . 'templates/parts/admin-options--footer.php');
                    submit_button(); ?>
                </form>
            </div>

            <div class="zdcell md-7 lg-8">
                <div class="zpwpcg-canvas__wrap zpwpcg-adm-canvas__wrap">
                    <div class="zpwpcg-canvas__wrap zpwpcg-adm-canvas__wrap">
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
</div>