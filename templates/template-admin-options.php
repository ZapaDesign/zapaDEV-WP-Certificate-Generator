<div class="zpwpcg-adm__wrap">
    <h1 class="zpwpcg-adm__title"><?php echo __('zapaDEV WP Certificate Generator', TR) ?></h1>
    <p><?php echo __('List of saved certificates. You can edit, delete the certificate entry, and view or download the certificate.', TR); ?></p>
    <?php
    $cert_args = array(
        'post_type'      => PREFIX . 'certificat',
        'posts_per_page' => -1,
        'orderby'        => get_cert_id_number('title'),
        'order'          => 'DESC',
    );

    $certificates = get_posts($cert_args);

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
                <th><?php echo __('Start', TR); ?></th>
                <th><?php echo __('Finish', TR); ?></th>
                <th><?php echo __('Level', TR); ?></th>
                <th><?php echo __('Hours', TR); ?></th>
                <th><?php echo __('Location', TR); ?></th>
                <th><?php echo __('Date', TR); ?></th>
                <th><?php echo __('Control', TR); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($certificates as $certificate):
                $post_meta = get_post_meta($certificate->ID, 'certificate_data');
                ?>
                <tr class="zpwpcg-table__item" data-id="<?php echo $certificate->ID; ?>">
                    <td data-label="ID"><?php echo $certificate->post_title; ?></td>
                    <td data-label="<?php echo __('Student', TR); ?>">
                        <strong><?php echo get_the_title($post_meta[0]['student']); ?></strong></td>
                    <td data-label="<?php echo __('Start', TR); ?>"><?php echo $post_meta[0]['start']; ?></td>
                    <td data-label="<?php echo __('Finish', TR); ?>"><?php echo $post_meta[0]['finish']; ?></td>
                    <td data-label="<?php echo __('Level', TR); ?>"><?php echo $post_meta[0]['level']; ?></td>
                    <td data-label="<?php echo __('Hours', TR); ?>"><?php echo $post_meta[0]['hours']; ?></td>
                    <td data-label="<?php echo __('Location', TR); ?>"><?php echo $post_meta[0]['place']; ?></td>
                    <td data-label="<?php echo __('Date', TR); ?>"><?php echo $post_meta[0]['date']; ?></td>
                    <td class="zpwpcg-table__item-buttons">
                        <button class="zpwpcg-btn zpwpcg-btn--edit">Edit</button>
                        <button class="zpwpcg-btn zpwpcg-btn--del">Delete</button>
                        <button class="zpwpcg-btn zpwpcg-btn--show">Show</button>
                        <button class="zpwpcg-btn zpwpcg-btn--download">Download</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!--                        <form method="post" action="options.php">
                            <p class="submit">
                                <input name="Submit" type="submit" class="button-primary" value="<?php /*esc_attr_e('Сохранить изменения'); */ ?>" >
                            </p>
                        </form>-->
</div>