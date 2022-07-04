<?php
/*
* @var $options
* */

?>

<div class="zpwpcg__form">
    <form class="zpwpcg-front-form" action="">
        <p>
            <label><?php echo $options['name']['label'] . ':' ?></label>
            <input id="zpwpcg-front__name-input"
                   list="zpwpcg-front__name-datalist"
                   class="zpwpcg__form--name"
                   type="text"
                   placeholder="Student Name">
            <datalist id="zpwpcg-front__name-datalist">
                <option value="Kateryna Bardysh">
                <option value="Mykhailo Bardysh">
                <option value="Arina Leshchenko">
                <option value="Nazar Samoilov">
                <option value="Selyn Kharyry">
                <option value="Sofiia Rubets">
                <option value="Dariia Tararaka"></option>
                <option value="Nikita Shcheholikhin"></option>
                <option value="Oleksandra Bereza"></option>
            </datalist>
        </p>

        <p>
          <!-- TODO  Chenge label -->
            <label><?php echo __('Custom certificate ID'); ?></label>
            <span>
                <input
                    class="zpwpcg-front-form__field--id-switcher"
                    id="zpwpcg-front__id-switcher"
                    type="checkbox">
                <input
                    class="zpwpcg-front-form__field--id"
                    type="text"
                    id="zpwpcg-front__id-input">
            </span>
        </p>
        
        <?php if( $options['period']['start'] ): ?>
            <p>
                <label><?php echo $options['period']['start'] . ':'; ?></label>
                <input
                    id="zpwpcg-front__start-input"
                    value="<?php echo date('Y', strtotime('-1 year', strtotime(date('Y')))) . '-09'; ?>"
                    type="month">
            </p>
        <?php endif; ?>
        <?php if( $options['period']['finish'] ): ?>
            <p>
                <label><?php echo $options['period']['finish'] . ':'; ?></label>
                <input
                    id="zpwpcg-front__finish-input"
                    value="<?php echo date('Y-m'); ?>"
                    type="month">
            </p>
        <?php endif; ?>
        <?php if( $options['levels']['label'] ): ?>
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
        <?php endif; ?>
        <?php if( $options['hours']['label'] ): ?>
            <p>
                <label><?php echo $options['hours']['label'] . ':'; ?></label>
                <input id="zpwpcg-front__hours-input"
                       class="zpwpcg__form--hours"
                       type="number"
                       value="<?php echo $options['hours']['value']; ?>">
            </p>
        <?php endif; ?>
        <?php if( $options['location']['label'] ): ?>
            <p>
                <label><?php echo $options['location']['label'] . ':'; ?></label>
                <input id="zpwpcg-front__location-input" type="text" value="<?php echo $options['location']['value']; ?>">
            </p>
        <?php endif; ?>
        <?php if( $options['date']['label'] ): ?>
            <p>
                <label><?php echo $options['date']['label'] . ':'; ?></label>
                <input id="zpwpcg-front__date-input" type="date" value="<?php echo date('Y-m-d'); ?>">
            </p>
        <?php endif; ?>
    </form>
    <div class="zpwpcg__buttons">
        <button id="zpwpcg-front__btn--download" class="zpwpcg-front__btn zpwpcg-front__btn--download button"><?php echo __('Download',
                'zapadev-wp-certificate-generator') ?></button>
        <button class="zpwpcg-front__btn button"><?php echo __('Print',
                'zapadev-wp-certificate-generator'); ?></button>
    </div>
</div>