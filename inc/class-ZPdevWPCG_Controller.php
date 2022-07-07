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
    }