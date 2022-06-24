<?php

$options = get_option(PREFIX.'option');
echo '<script>let options = ' . json_encode($options) . ';</script>';

if($options): ?>
    <div id="zpdevwpcgFront" class="zdcontainer">
    <div class="zdgrid">
        <div class="zdcell">
            <?php include_once(DIR_PATH . '/templates/parts/form.php'); ?>
        </div>

        <div class="zdcell">
            <div class="zpwpcg-canvas__wrap">
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
    <h2><?php echo __('Plugin not configured', TR_ID); ?></h2>
    <p><?php  ?>
        
        <?php printf('') ?>
        <?php echo __('Plugin <b>' . PL_NAME . '</b>', TR_ID ); ?></p>
<<?php endif; ?>
