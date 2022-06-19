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
                        <input type="text" placeholder="Student Name">
                    </p>

                    <h3>Course dates:</h3>
                    <p>
                        <label>Start</label>
                        <input type="month">
                    </p>
                    <p>
                        <label>Finish</label>
                        <input type="month">
                    </p>

                    <h3>Level</h3>
                    <p>
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
                        <input type="date" value="">
                    </p>
                </form>
                <button>Download</button>
                <button>Print</button>
            </div>
        </div>

        <div class="zdcell">
            <div
                class="zdwpcg__preview"
<!--                style="background-image: url("--><?php //echo wp_get_attachment_url($cert_img_id); ?><!--")"-->
            >
            <img src="<?php echo wp_get_attachment_url($cert_img_id); ?>" alt="">

            </div>
        </div>
    </div>
</div>
