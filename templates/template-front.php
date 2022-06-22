<?php

$options = get_option('zpdevwpcg_option');

$img_url = $options['img'];

$name_label = $options['name_label'];

$top_text           = $options['top_text'];
$bottom_text        = $options['bottom_text'];
$bottom_strong_text = $options['bottom_strong_text'];

$level_label = $options['level_label'];
$levels      = $options['levels'];
$place_label = $options['place_label'];
$place = $options['place'];

$logo_url       = $options['logo'];
$address        = $options['address'];
$signature_url  = $options['signature'];
$director_label = $options['director']['label'];
$director       = $options['director']['value'];

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
                        <label><?php echo $name_label . ':' ?></label>
                        <input id="zpwpcg__form--name" class="zpwpcg__form--name" type="text" placeholder="Student Name">
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
                        <label><?php echo $level_label . ':'; ?></label>
                        <select @change="onChange" name="level" id="level">

                            <?php
                                foreach ($levels as $level):
                                printf('<option value="%s" data-level="%s" data-desc="%s">%s</option>', $level['level'], $level['level'], $level['desc'], $level['level']);
                                endforeach;
                            ?>
                        </select>
                    </p>
                    <p>
                        <label>{{hoursLabel}}:</label>
                        <input id="zpwpcg__form--hours" class="zpwpcg__form--hours" type="number" value="156">
                    </p>
                    <p>
                        <label><?php echo $place_label; ?></label>
                        <input id="zpwpcg__form--place" type="text" value="!!!">
                    </p>
                    <p>
                        <label>{{dateLabel}}:</label>
                        <input v-model="date" type="date" value="<?php echo date('Y-m-d'); ?>">
                    </p>
                </form>
                <div class="zpwpcg__buttons">
                    <a href="#" class="zpwpcg-front__btn zpwpcg-front__btn--download button"><?php echo __('Download', 'zapadev-wp-certificate-generator') ?></a>
                    <button class="zpwpcg-front__btn button"><?php echo __('Print', 'zapadev-wp-certificate-generator'); ?></button>
                </div>
            </div>
        </div>

        <div class="zdcell">
            <div class="zpwpcg-canvas__wrap">
                <canvas
                    class="zpwpcg-canvas"
                    id="zpwpcg-canvas"
                    data-imgsrc="<?php echo $img_url; ?>"
                    width="2480"
                    height="3508"
                ></canvas>
            </div>
            
            <div class="zpwpcg-preview">
                <img class="zpwpcg-preview__img" src="<?php echo $img_url; ?>" alt="">

                <div class="zpwpcg-preview__field zpwpcg-preview__field--cert-number">{{certNumber}}</div>
                
                <div class="zpwpcg-preview__header">

                </div>

                <div class="zpwpcg-preview__body">
                    <div class="zpwpcg-preview__field"><?php echo $top_text; ?></div>
                    <div class="zpwpcg-preview__field zpwpcg-preview__field--name">{{name}}</div>
                    <div class="zpwpcg-preview__field"><?php echo $bottom_text; ?></div>
                    <div class="zpwpcg-preview__field zpwpcg-preview__field--strong"><?php echo $bottom_strong_text; ?></div>
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
                            <td class="zpwpcg-preview__label"><?php echo $level_label . ':'; ?></td>
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
                            <img src="<?php echo $logo_url; ?>" alt="Certificate logo">
                        </div>
                        <div class="zpwpcg-preview__field zpwpcg-preview__field--address"><?php echo $address; ?></div>
                    </div>
                    <div class="zpwpcg-preview__field zpwpcg-preview__field--signature">
                        <img src="<?php echo $signature_url; ?>" alt="Certificate signature">
                    </div>
                    <div class="zpwpcg-preview__footer-row zpwpcg-preview__footer-row--director">
                        <div class="zpwpcg-preview__field"><?php echo $director; ?></div>
                        <div class="zpwpcg-preview__field"><?php echo $director_label; ?></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="module">
    import {createApp} from 'vue'

    createApp({
        data() {
            return {
                certNumber: '555/22',
                name: '',
                periodLabel: '<?php echo $options['period']; ?>',
                periodStart: '<?php echo date('Y', strtotime('-1 year', strtotime(date('Y')))); ?>-09',
                periodFinish: '<?php echo date('Y-m'); ?>',
                level: 'Primary 1',
                levelDesc: '',
                hoursLabel: '<?php echo $options['hours']; ?>',
                hours: 156,
                placeLabel: '<?php echo $options['place']; ?>',
                place: 'Poltava (UKRAINE)',
                dateLabel: '<?php echo $options['date']; ?>',
                date: '<?php echo date('Y-m-d'); ?>',

            }
        },
        methods: {
            onChange(e) {
                if (e.target.options.selectedIndex > -1) {
                    const theTarget = e.target.options[e.target.options.selectedIndex].dataset;
                    this.level = theTarget.level
                    this.levelDesc = theTarget.desc
                }
            },
            // updateCanvas: function (){
            //     var canvas = document.getElementById('zpwpcg-canvas'),
            //         ctx = canvas.getContext('2d');
            //     ctx.clearRect(0,0,canvas.width,canvas.height);
            //     ctx.fillStyle = "black";
            //     ctx.font="20px Georgia";
            //     ctx.fillText(this.name,10,50);
            //     ctx.fillText(this.hours,20,100);
            // }
        },

        // watch: {
        //     name: function(val, oldVal) {
        //         this.updateCanvas();
        //     },
        //     hours: function(val, oldVal) {
        //         this.updateCanvas();
        //     }
        // },
        // mounted: function (){
        //     this.updateCanvas();
        // }
    }).mount('#zpdevwpcgFront')
</script>

