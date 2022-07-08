<?php
    
    namespace ZPdevWPCG;
    
    class Controller {
        
        protected $controlArr;
        
        public function __construct( ...$controlArr ) {
            $this->controlArr = $controlArr;
        }
        
        public function render() {
            echo '<div class="zpwpcg-controller__wrap">';
            printf( '<button type="button" class="zpwpcg-controller__toggle"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M495.9 166.6c3.3 8.6.5 18.3-6.3 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4c0 8.6-.6 17.1-1.7 25.4l43.3 39.4c6.8 6.3 9.6 16 6.3 24.6c-4.4 11.9-9.7 23.4-15.7 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.3c-6 7.1-15.7 9.6-24.5 6.8l-55.7-17.8c-13.4 10.3-29.1 18.9-44 25.5l-12.5 57.1c-2 9-9 15.4-18.2 17.8c-13.8 2.3-28 3.5-43.4 3.5c-13.6 0-27.8-1.2-41.6-3.5c-9.2-2.4-16.2-8.8-18.2-17.8l-12.5-57.1c-15.8-6.6-30.6-15.2-44-25.5l-55.66 17.8c-8.84 2.8-18.59.3-24.51-6.8c-8.11-9.9-15.51-20.3-22.11-31.3l-4.68-8.1c-6.07-10.9-11.35-22.4-15.78-34.3c-3.24-8.6-.51-18.3 6.35-24.6l43.26-39.4C64.57 273.1 64 264.6 64 256c0-8.6.57-17.1 1.67-25.4l-43.26-39.4c-6.86-6.3-9.59-15.9-6.35-24.6c4.43-11.9 9.72-23.4 15.78-34.3l4.67-8.1c6.61-11 14.01-21.4 22.12-31.25c5.92-7.15 15.67-9.63 24.51-6.81l55.66 17.76c13.4-10.34 28.2-18.94 44-25.47l12.5-57.1c2-9.08 9-16.29 18.2-17.82C227.3 1.201 241.5 0 256 0s28.7 1.201 42.5 3.51c9.2 1.53 16.2 8.74 18.2 17.82l12.5 57.1c14.9 6.53 30.6 15.13 44 25.47l55.7-17.76c8.8-2.82 18.5-.34 24.5 6.81c8.1 9.85 15.5 20.25 22.1 31.25l4.7 8.1c6 10.9 11.3 22.4 15.7 34.3zM256 336c44.2 0 80-35.8 80-80.9c0-43.3-35.8-80-80-80s-80 36.7-80 80c0 45.1 35.8 80.9 80 80.9z"/></svg>%s</button>', __( 'Settings', TR ) );
            echo '<div class="zpwpcg-controller__list">';
            $controlArr = $this->controlArr;
            $options = get_option(PREFIX.'option');
            
            foreach ($controlArr as $control) {
                if ( $control['type'] === 'range' ): ?>
                    <div class="zpwpcg-controller__item">
                        <div class="zpwpcg-controller--range" data-param="<?php echo $control['field'] . '-' . $control['param']; ?>">
                            <label for="zpdevwpcg_option[<?php echo  $control['field']; ?>][<?php echo $control['param']; ?>]">
                                <?php echo $control['label']; ?>
                            </label>
                            <input
                                class="zpwpcg-tuning__field zpwpcg-controller--range__range"
                                type="range"
                                step="<?php echo $control['args']['step'] ? $control['args']['step'] : 1; ?>"
                                max="<?php echo $control['args']['max'] ? $control['args']['max'] : 100; ?>"
                                name="zpdevwpcg_option[<?php echo  $control['field']; ?>][<?php echo $control['param']; ?>]"
                                value="<?php
                                    echo isset( $options[$control['field']][$control['param']] ) ?
                                        esc_attr( $options[$control['field']][$control['param']] ) :
                                        2480; ?>"
                            >
                            <input
                                class="zpwpcg-tuning__field zpwpcg-controller--range__input"
                                type="number"
                                step="<?php echo $control['args']['step'] ? $control['args']['step'] : 1; ?>"
                                name="zpdevwpcg_option[<?php echo  $control['field']; ?>][<?php echo $control['param']; ?>]"
                                value="<?php
                                    echo isset( $options[$control['field']][$control['param']] ) ?
                                        esc_attr( $options[$control['field']][$control['param']] ) :
                                        3508; ?>"
                            >
                        </div>
                    </div>
                <?php endif;
            }
            
            echo '</div>';
            echo '</div>';
        }
    
    
        public function render2 (
            $field,
            $y_position = 0,
            $x_position = 0,
            $align = '',
            $fontsize = 0,
            $fontweight = ''
        ) {
            echo '<div class="zpwpcg-control">';
                echo '<button type="button" class="zpwpcg-control__toggle">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M495.9 166.6c3.3 8.6.5 18.3-6.3 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4c0 8.6-.6 17.1-1.7 25.4l43.3 39.4c6.8 6.3 9.6 16 6.3 24.6c-4.4 11.9-9.7 23.4-15.7 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.3c-6 7.1-15.7 9.6-24.5 6.8l-55.7-17.8c-13.4 10.3-29.1 18.9-44 25.5l-12.5 57.1c-2 9-9 15.4-18.2 17.8c-13.8 2.3-28 3.5-43.4 3.5c-13.6 0-27.8-1.2-41.6-3.5c-9.2-2.4-16.2-8.8-18.2-17.8l-12.5-57.1c-15.8-6.6-30.6-15.2-44-25.5l-55.66 17.8c-8.84 2.8-18.59.3-24.51-6.8c-8.11-9.9-15.51-20.3-22.11-31.3l-4.68-8.1c-6.07-10.9-11.35-22.4-15.78-34.3c-3.24-8.6-.51-18.3 6.35-24.6l43.26-39.4C64.57 273.1 64 264.6 64 256c0-8.6.57-17.1 1.67-25.4l-43.26-39.4c-6.86-6.3-9.59-15.9-6.35-24.6c4.43-11.9 9.72-23.4 15.78-34.3l4.67-8.1c6.61-11 14.01-21.4 22.12-31.25c5.92-7.15 15.67-9.63 24.51-6.81l55.66 17.76c13.4-10.34 28.2-18.94 44-25.47l12.5-57.1c2-9.08 9-16.29 18.2-17.82C227.3 1.201 241.5 0 256 0s28.7 1.201 42.5 3.51c9.2 1.53 16.2 8.74 18.2 17.82l12.5 57.1c14.9 6.53 30.6 15.13 44 25.47l55.7-17.76c8.8-2.82 18.5-.34 24.5 6.81c8.1 9.85 15.5 20.25 22.1 31.25l4.7 8.1c6 10.9 11.3 22.4 15.7 34.3zM256 336c44.2 0 80-35.8 80-80.9c0-43.3-35.8-80-80-80s-80 36.7-80 80c0 45.1 35.8 80.9 80 80.9z"/>
                          </svg>';
                    echo __('Settings', TR);
                echo '</button>';
                echo '<div class="zpwpcg-control__list">';
                
        
            if ($x_position): ?>
                <div class="zpwpcg-control__item">
                    <label for="zpdevwpcg_option<?php echo '['.$field.'][x_position]'; ?>">
                        <?php echo __('X position', TR); ?>
                    </label>

                    <input class="zpwpcg-tuning__field zpwpcg-tuning__field--x"
                           type="range"
                           step="0.1"
                           data-param ="<?php echo $field; ?>"
                           name="zpdevwpcg_option<?php echo '['.$field.'][x_position]'; ?>"
                           value="<?php echo isset($this->options[$field]['x_position']) ? esc_attr($this->options[$field]['x_position']) : 32; ?>">
                    <input type="number">
                </div>
            <?php endif;
        
            if ($align): ?>
                <fieldset class="zpwpcg-control__item" id="group1">
                    <div>
                        <legend><?php echo __('Alignment', TR); ?></legend>
                    </div>

                    <div>
                        <input
                            class="zpwpcg-tuning__field--align"
                            data-param="<?php echo $field; ?>"
                            type="radio"
                            id="contactChoice1"
                            name="zpdevwpcg_option<?php echo '['.$field.'][align]'; ?>"
                            <?php echo checked( 'left', $this->options[$field]['align'] ? $this->options[$field]['align'] : $align, true ); ?>
                            value="left">
                        <label for="contactChoice1"><?php echo __('Left', TR) ?></label>

                        <input
                            class="zpwpcg-tuning__field--align"
                            data-aram="<?php echo $field; ?>"
                            type="radio"
                            id="contactChoice2"
                            name="zpdevwpcg_option<?php echo '['.$field.'][align]'; ?>"
                            <?php echo checked( 'center', $this->options[$field]['align'] ? $this->options[$field]['align']  : $align, true ); ?>
                            value="center">
                        <label for="contactChoice2"><?php echo __('Center', TR); ?></label>

                        <input
                            class="zpwpcg-tuning__field--align"
                            data-aram="<?php echo $field; ?>"
                            type="radio"
                            id="contactChoice3"
                            name="zpdevwpcg_option<?php echo '['.$field.'][align]'; ?>"
                            <?php echo checked( 'right', $this->options[$field]['align'] ? $this->options[$field]['align'] : $align, true ); ?>
                            value="right">
                        <label for="contactChoice3"><?php echo __('Right', TR); ?></label>
                    </div>

                </fieldset>
            <?php endif;
        
            if ($fontsize):?>
                <div class="zpwpcg-control__item">
                    <label for="zpdevwpcg_option<?php echo '['.$field.'][font_size]'; ?>">
                        <?php echo __('Font size', TR); ?>
                    </label>

                    <input class="zpwpcg-tuning__field zpwpcg-tuning__field--y"
                           type="range"
                           step="0.1"
                           data-param ="<?php echo $field; ?>"
                           name="zpdevwpcg_option<?php echo '['.$field.'][font_size]'; ?>"
                           value="<?php echo isset($this->options[$field]['font_size']) ? esc_attr($this->options[$field]['font_size']) : 55; ?>">
                    <input class="zpwpcg-tuning__field zpwpcg-tuning__field--font-size"
                           type="number"
                           name="zpdevwpcg_option<?php echo '['.$field.'][font_size]'; ?>"
                           data-aram ="<?php echo $field; ?>"
                           value="<?php echo isset($this->options[$field]['font_size']) ? esc_attr($this->options[$field]['font_size']) : 200; ?>"
                    >

                </div>
            <?php endif;
        
            if ($fontweight):?>
                <div class="zpwpcg-control__item">
                    <label for="zpdevwpcg_option<?php echo '['.$field.'][font_weight]'; ?>">
                        <?php echo __('Font weight', TR); ?>
                    </label>
                    <div>
                        <select
                            class="zpwpcg-tuning__field--font-weight"
                            data-aram="<?php echo $field; ?>"
                            name="zpdevwpcg_option<?php echo '['.$field.'][font_weight]'; ?>" id="">
                            <option
                                value="400"
                                <?php echo selected( $this->options['font_weight'], '400', false); ?>>
                                normal
                            </option>
                            <option
                                value="700"
                                <?php echo selected( $this->options['font_weight'], '700', false); ?>>
                                bold
                            </option>
                        </select>
                    </div>


                </div>
            <?php endif;
        
        
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        public function render_x_position($y_position) {
            if ($y_position): ?>
                <div class="zpwpcg-control__item">
                    <label for="zpdevwpcg_option<?php echo '['.$field.'][y_position]'; ?>">
                        <?php echo __('Y position', TR); ?>
                    </label>

                    <input class="zpwpcg-tuning__field zpwpcg-tuning__field--y"
                           type="range"
                           step="0.1"
                           data-param ="<?php echo $field; ?>"
                           name="zpdevwpcg_option<?php echo '['.$field.'][y_position]'; ?>"
                           value="<?php echo isset($this->options[$field]['y_position']) ? esc_attr($this->options[$field]['y_position']) : 55; ?>">
                    <input type="number" >
                </div>
            <?php endif;
        }
    }