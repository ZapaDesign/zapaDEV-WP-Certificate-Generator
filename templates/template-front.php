<?php


/*
* TODO Перенести передачу скриптов
* */
$options = get_option(PREFIX.'option');

$cert_args = array(
    'post_type' =>'zpdevwpcg_certificat',
    'posts_per_page' => 1
);

if($cert_last = wp_get_recent_posts($cert_args)) {
    $last_cert_id  = get_cert_id_number($cert_last[0]['post_title']) + 1;
} else {
    $last_cert_id = '1';
}

echo '<script>let options = ' . json_encode($options) . ';</script>';
echo '<script>let lastCertID = ' . json_encode($last_cert_id) . ';</script>';

if($options): ?>
    <div id="zpdevwpcgFront" class="zdcontainer">
    <div class="zdgrid zdgrid--x zdgrid--y">
        <div class="zdcell md-5 lg-4">
            <?php include_once(DIR_PATH . '/templates/parts/form.php'); ?>
        </div>

        <div class="zdcell md-7 lg-8">
            <div class="zpwpcg-canvas__wrap">
                <!--// TODO Добавить асинхронную загрузку изображений-->
                <canvas
                    class="zpwpcg-canvas"
                    id="zpwpcg-canvas"
                    data-imgsrc="<?php echo $options['img']; ?>"
                    width="2480"
                    height="3508"
                ></canvas>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <h2><?php echo __('Plugin not configured', TR); ?></h2>
    <p><?php  ?>
        
        <?php printf('') ?>
        <?php echo __('Plugin <b>' . PL_NAME . '</b> not configured. Please configure the plugin on the settings page' , TR ); ?></p>
<?php endif; ?>
