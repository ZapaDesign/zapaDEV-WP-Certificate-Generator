<?php

$options     = get_option('zpdevwpcg_option');
$cert_img_id = $options['img'];

?>

<script type="importmap">
  {
    "imports": {
      "vue": "https://unpkg.com/vue@3/dist/vue.esm-browser.js"
    }
  }
</script>

<div id="zpdevwpcgFront" class="zdcontainer">
    <div class="zdgrid">
        <div class="zdcell">
            <div class="zpwpcg__form">
                <form action="">
                    <p>
                        <label>{{nameLabel}}:</label>
                        <input v-model="name" class="zpwpcg__form--name" type="text" placeholder="Student Name">
                    </p>

                    <p>
                        <label>Start</label>
                        <input
                            v-model="periodStart"
                            type="month">
                    </p>
                    <p>
                        <label>Finish</label>
                        <input
                            v-model="periodFinish"
                            type="month">
                    </p>

                    <p>
                        <label>{{levelLabel}}</label>
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
                        <label>{{hoursLabel}}:</label>
                        <input v-model="hours" class="zpwpcg__form--hours" type="number">
                    </p>
                    <p>
                        <label>{{placeLabel}}:</label>
                        <input v-model="place" type="text">
                    </p>
                    <p>
                        <label>{{dateLabel}}:</label>
                        <input v-model="date" type="date" value="<?php echo date('Y-m-d'); ?>">
                    </p>
                </form>
                <div class="zpwpcg__buttons">
                    <button id="zpwpcgDownload" class="button">Download</button>
                    <button class="button">Print</button>
                </div>
            </div>
        </div>

        <div class="zdcell">
            <div class="zpwpcg-preview">
                <img class="zpwpcg-preview__img" src="<?php echo wp_get_attachment_url($cert_img_id); ?>" alt="">


                <div class="zpwpcg-preview__header">

                </div>


                <div class="zpwpcg-preview__body">
                    <div class="zpwpcg-preview__field zpwpcg-preview__field--name">{{name}}</div>
                </div>


                <div class="zpwpcg-preview__grid">
                    <div class="zpwpcg-preview__grid-row">
                        <span>{{periodLabel}}:</span>
                        <span class="zpwpcg-preview__field">{{periodStart}}</span>
                        <span>-</span>
                        <span class="zpwpcg-preview__field">{{periodFinish}}</span>
                    </div>
                    <div class="zpwpcg-preview__grid-row">
                        <span>{{levelLabel}}:</span>
                        <span class="zpwpcg-preview__field">{{level}}</span>
                    </div>
                    <div class="zpwpcg-preview__grid-row">
                        <span>{{hoursLabel}}:</span>
                        <span class="zpwpcg-preview__field">{{hours}}</span>
                    </div>
                    <div class="zpwpcg-preview__grid-row">
                        <span>{{placeLabel}}:</span>
                        <span class="zpwpcg-preview__field">{{place}}</span>
                    </div>
                    <div class="zpwpcg-preview__grid-row">
                        <span>{{dateLabel}}:</span>
                        <span class="zpwpcg-preview__field">{{date}}</span>
                    </div>

                </div>


                <div class="zpwpcg-preview__footer">

                </div>

            </div>
        </div>
    </div>
</div>

<script type="module">
    import { createApp } from 'vue'

    createApp({
        data() {
            return {
                nameLabel: 'Name',
                name: '',

                periodLabel: '<?php echo $options['period']; ?>',
                periodStart: '<?php echo date('Y', strtotime('-1 year', strtotime(date('Y')))); ?>-09',
                periodFinish: '<?php echo date('Y-m'); ?>',

                levelLabel: '<?php echo $options['level_label']; ?>',
                level: 'B1',

                hoursLabel: '<?php echo $options['hours']; ?>',
                hours: 156,

                placeLabel: '<?php echo $options['place']; ?>',
                place: 'Poltava (UKRAINE)',

                dateLabel: '<?php echo $options['date']; ?>',
                date: '<?php echo date('Y-m-d'); ?>',


                director: '<?php echo $options['director']; ?>',
            }
        }
    }).mount('#zpdevwpcgFront')
</script>

