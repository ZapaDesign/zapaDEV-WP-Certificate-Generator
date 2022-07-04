<div class="zpwpcg-adm__wrap">
    <h1 class="zpwpcg-adm__title"><?php echo __('Students', TR) ?></h1>
    <p><?php echo __('List of saved student\'s name. You can edit and delete the students entry.', TR); ?></p>
    <?php
    $std_args = array(
        'post_type'      => PREFIX . 'student',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    );

    $students = get_posts($std_args);

    ?>
    <div class="zpwpcg-ajax">
        <div class="zpwpcg-ajax__loader">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <table class="zpwpcg-table zpwpcg-table--adm">
            <thead>
            <tr>
                <th>ID</th>
                <th><?php echo __('Student', TR); ?></th>
                <th><?php echo __('Last certificate level', TR); ?></th>
                <th><?php echo __('Last certificate date', TR); ?></th>
                <th><?php echo __('Control', TR); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $student): ?>
                <tr class="zpwpcg-table__item" data-id="<?php echo $student->ID; ?>">
                    <td data-label="ID"><?php echo $student->ID; ?></td>
                    <td data-label="<?php echo __('Student', TR); ?>">
                        <strong><?php echo $student->post_title; ?>
                    </td>
                    <td data-label="<?php echo __('Level', TR); ?>"></td>
                    <td data-label="<?php echo __('Date', TR); ?>"></td>

                    <td class="zpwpcg-table__item-buttons">
                        <button class="zpwpcg-btn zpwpcg-btn--edit">Edit</button>
                        <button class="zpwpcg-btn zpwpcg-btn--del">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
<!--        <ul class="zpwpcg-list">
            <?php /*foreach ($students as $student): */?>
                <li class="zpwpcg-list__item" data-id="<?php /*echo $student->ID; */?>">
                    <div><b><?php /*echo $student->post_title; */?></b></div>
                    <div>
                        <button class="zpwpcg-btn zpwpcg-btn--edit">Edit</button>
                        <button class="zpwpcg-btn zpwpcg-btn--del">Delete</button>
                    </div>
                </li>
            <?php /*endforeach; */?>
        </ul>-->
    </div>
</div>