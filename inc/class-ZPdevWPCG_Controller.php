<?php
    
    namespace ZPdevWPCG;
    
    class Controller {
        
        protected $controlArr;
        
        public function __construct( ...$controlArr ) {
            $this->controlArr = $controlArr;
        }
        
        public function render() {
            echo '<div class="zpwpcg-controller__wrap">';
            printf( '<button type="button" class="zpwpcg-controller__toggle">%s</button>', __( 'Settings', TR ) );
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