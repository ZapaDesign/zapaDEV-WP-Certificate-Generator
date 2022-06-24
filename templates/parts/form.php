<div class="zpwpcg__form">
    <form action="">
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