<div class="zpwpcg-adm__wrap">
    <h1 class="zpwpcg-adm__title"><?php echo __('zapaDEV WP Certificate Generator', TR_ID) ?></h1>
    <?php
    $cert_args = array(
        'post_type'      => 'zpdevwpcg_certificat',
        'posts_per_page' => -1,
        'orderby'        => get_cert_id_number('title'),
        'order'          => 'DESC',
    );

    $certificates = get_posts($cert_args);
    
    ?>
    <div class="zpwpcg-ajax">
        <div class="zpwpcg-ajax__loader">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
        <table class="zpwpcg-adm-certlist">
            <thead>
            <tr>
                <th>ID</th>
                <th><?php echo __('Student', TR_ID); ?></th>
                <th><?php echo __('Start', TR_ID); ?></th>
                <th><?php echo __('Finish', TR_ID); ?></th>
                <th><?php echo __('Level', TR_ID); ?></th>
                <th><?php echo __('Hours', TR_ID); ?></th>
                <th><?php echo __('Location', TR_ID); ?></th>
                <th><?php echo __('Date', TR_ID); ?></th>
                <th><?php echo __('Control', TR_ID); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($certificates as $certificate):
                $post_meta = get_post_meta($certificate->ID, 'certificate_data');
                ?>
                <tr class="zpwpcg-adm-certlist__item"
                    data-id="<?php echo $certificate->ID; ?>">
                    <td><?php echo $certificate->post_title; ?></td>
                    <td><b><?php echo get_the_title($post_meta[0]['student']); ?></b></td>
                    <td><?php echo $post_meta[0]['start']; ?></td>
                    <td><?php echo $post_meta[0]['finish']; ?></td>
                    <td><?php echo $post_meta[0]['level']; ?></td>
                    <td><?php echo $post_meta[0]['hours']; ?></td>
                    <td><?php echo $post_meta[0]['place']; ?></td>
                    <td><?php echo $post_meta[0]['date']; ?></td>
                    <td>
                        <button class="zpwpcg-adm__btn zpwpcg-adm__btn--edit">Edit</button>
                        <button class="zpwpcg-adm__btn zpwpcg-adm__btn--del">Delete</button>
                        <button class="zpwpcg-adm__btn zpwpcg-adm__btn--show">Show</button>
                        <button class="zpwpcg-adm__btn zpwpcg-adm__btn--download">Download</button>
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