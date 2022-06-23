<?php

$options = get_option('zpdevwpcg_option');
echo '<script>let options = ' . json_encode($options) . ';</script>';

if($options): ?>
    <div id="zpdevwpcgFront" class="zdcontainer">
    <div class="zdgrid">
        <div class="zdcell">
            <div class="zpwpcg__form">
                <form action="">
                    <p>
                        <label><?php echo $options['name']['label'] . ':' ?></label>
                        <input id="zpwpcg__form--name"
                               class="zpwpcg__form--name"
                               type="text"
                               placeholder="Student Name">
                    </p>
                    <p>
                        <label><?php echo $options['period']['start'] . ':'; ?></label>
                        <input
                            id="zpwpcg-front__start-input"
                            value="<?php echo date('Y', strtotime('-1 year', strtotime(date('Y')))) . '-09'; ?>"
                            type="month">
                    </p>
                    <p>
                        <label><?php echo $options['period']['finish'] . ':'; ?></label>
                        <input
                            id="zpwpcg-front__finish-input"
                            value="<?php echo date('Y-m'); ?>"
                            type="month">
                    </p>
                    <p>
                        <label><?php echo $options['levels']['label'] . ':'; ?></label>
                        <select
                            name="level"
                            id="zpwpcg-front__level-select">
                            <?php

                            $levels_arr = $options['levels']['list'];

                            foreach ($levels_arr as $level):
                                printf('<option value="%s" data-level="%s" data-desc="%s">%s</option>',
                                    $level['value'], $level['value'], $level['desc'], $level['value']);
                            endforeach;
                            ?>
                        </select>
                    </p>
                    <p>
                        <label><?php echo $options['hours']['label'] . ':'; ?></label>
                        <input id="zpwpcg-front__hours-input"
                               class="zpwpcg__form--hours"
                               type="number"
                               value="<?php echo $options['hours']['value']; ?>">
                    </p>
                    <p>
                        <label><?php echo $options['place']['label'] . ':'; ?></label>
                        <input id="zpwpcg-front__place-input" type="text" value="<?php echo $options['place']['value']; ?>">
                    </p>
                    <p>
                        <label><?php echo $options['date']['label']; ?></label>
                        <input id="zpwpcg-front__date-input" type="date" value="<?php echo date('Y-m-d'); ?>">
                    </p>
                </form>
                <div class="zpwpcg__buttons">
                    <button id="zpwpcg-front__btn--download" class="zpwpcg-front__btn zpwpcg-front__btn--download button"><?php echo __('Download',
                            'zapadev-wp-certificate-generator') ?></button>
                    <button class="zpwpcg-front__btn button"><?php echo __('Print',
                            'zapadev-wp-certificate-generator'); ?></button>
                </div>
            </div>
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

            <!--            <div class="zpwpcg-preview">
                <img class="zpwpcg-preview__img" src="<?php /*echo $img_url; */ ?>" alt="">

                <div class="zpwpcg-preview__field zpwpcg-preview__field--cert-number">{{certNumber}}</div>
                
                <div class="zpwpcg-preview__header">

                </div>

                <div class="zpwpcg-preview__body">
                    <div class="zpwpcg-preview__field zpwpcg-preview__field--top-text"><?php /*echo $top_text; */ ?></div>
                    <div class="zpwpcg-preview__field zpwpcg-preview__field--name">{{name}}</div>
                    <div class="zpwpcg-preview__field"><?php /*echo $bottom_text; */ ?></div>
                    <div class="zpwpcg-preview__field zpwpcg-preview__field--strong"><?php /*echo $bottom_strong_text; */ ?></div>
                </div>

                <div class="zpwpcg-preview__grid">
                    <table>
                        <tr>
                            <td class="zpwpcg-preview__label">{{periodLabel}}:</td>
                            <td>
                                <span class="zpwpcg-preview__field">{{periodStart}}</span>
                                <span>-</span>
                                <span class="zpwpcg-preview__field">{{periodFinish}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="zpwpcg-preview__label"><?php /*echo $level_label . ':'; */ ?></td>
                            <td>
                                <div class="zpwpcg-preview__field">{{level}}</div>
                                <div class="zpwpcg-preview__field zpwpcg-preview__field--level-desc">{{levelDesc}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="zpwpcg-preview__label">{{hoursLabel}}:</td>
                            <td>{{hours}}</td>
                        </tr>
                        <tr>
                            <td class="zpwpcg-preview__label">{{placeLabel}}:</td>
                            <td>{{place}}</td>
                        </tr>
                        <tr>
                            <td class="zpwpcg-preview__label">{{dateLabel}}:</td>
                            <td>{{date}}</td>
                        </tr>
                    </table>
                </div>

                <div class="zpwpcg-preview__footer">
                    <div class="zpwpcg-preview__footer-row">
                        <div class="zpwpcg-preview__field zpwpcg-preview__field--logo">
                            <img src="<?php /*echo $logo_url; */ ?>" alt="Certificate logo">
                        </div>
                        <div class="zpwpcg-preview__field zpwpcg-preview__field--address"><?php /*echo $address; */ ?></div>
                    </div>
                    <div class="zpwpcg-preview__field zpwpcg-preview__field--signature">
                        <img src="<?php /*echo $signature_url; */ ?>" alt="Certificate signature">
                    </div>
                    <div class="zpwpcg-preview__footer-row zpwpcg-preview__footer-row--director">
                        <div class="zpwpcg-preview__field"><?php /*echo $director; */ ?></div>
                        <div class="zpwpcg-preview__field"><?php /*echo $director_label; */ ?></div>
                    </div>
                </div>

            </div>-->
        </div>
    </div>
</div>
<?php else: ?>
    <h2><?php echo __('Plugin not configured', TR_ID); ?></h2>
    <p><?php  ?>
        
        <?php printf('') ?>
        <?php echo __('Plugin <b>' . PL_NAME . '</b>', TR_ID ); ?></p>
<<?php endif; ?>
