<?php

$options = get_option('zpdevwpcg_option');
$cert_img_id = $options['img'];

?>
<div class="zdcontainer">
    <div class="zdgrid">
        <div class="zdcell">
            <div class="zpwpcg__form">
                <form action="">
                    <p>
                        <label>Name</label>
                        <input class="zpwpcg__form-name" type="text" placeholder="Student Name">
                    </p>

                   <p>
                        <label>Start</label>
                        <input type="month" value="<?php echo date('Y',strtotime ( '-1 year' , strtotime ( date('Y') ) )); ?>-09">
                    </p>
                    <p>
                        <label>Finish</label>
                        <input type="month" value="<?php echo date('Y-m'); ?>">
                    </p>

                    <p>
                        <label>Level</label>
                        <select name="level" id="level">
                            <option value="Primary 1">Primary 1</option>
                            <option value="Primary 2">Primary 2</option>
                            <option value="Primary 3">Primary 3</option>
                            <option value="Primary 4">Primary 4</option>
                            <option value="A1">A1</option>
                            <option value="A2">A2</option>
                            <option value="B1">B1</option>
                            <option value="B2">B2</option>
                        </select>
                    </p>

                    <p>
                        <label><?php echo $options['hours'] . ':'; ?></label>
                        <input type="number" value="156">
                    </p>
                    <p>
                        <label>Place of Study:</label>
                        <input type="text" value="Poltava (UKRAINE)">
                    </p>
                    <p>
                        <label>Date of issue:</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>">
                    </p>
                </form>
                <div class="zpwpcg__buttons">
                    <button id="zpwpcgDownload" class="button">Download</button>
                    <button class="button">Print</button>
                </div>
            </div>
        </div>

        <div class="zdcell">
            <div class="zpwpcg__preview">
                <img class="zdwpcg__preview-img" src="<?php echo wp_get_attachment_url($cert_img_id); ?>" alt="">
                <div class="zpwpcg__preview-name"></div>
            </div>
        </div>
    </div>
</div>

