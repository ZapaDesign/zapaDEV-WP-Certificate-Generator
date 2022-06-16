<div bp-layout="row stretch">
    <div bp-layout="col 5@md 4@lg 3@xl">
        <div class="zapadevwpcg__form">
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
                    <label>Number of hours:</label>
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

    <div bp-layout="col 7@md 8@lg 9@xl">
        <div class="certificate-generator__preview">
            <h2>Preview</h2>
            <?php if( $image = get_field('certificate_image') ): ?>
                <img class="card__img no-lazy" src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>
    </div>
</div>