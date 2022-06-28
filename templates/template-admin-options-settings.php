<div class="wrap">
    <h1><?php
            echo __( 'Settings', TR_ID ) ?></h1>
    <form method="post" action="options.php">
        <?php
            // This prints out all hidden setting fields
            settings_fields( PREFIX . 'settings_option_group' );
            do_settings_sections( PREFIX . 'settings' );
            submit_button();
        ?>
    </form>
    
    <!-- TODO (УДАЛИТЬ) var_dump zpdevwpcg_options - опции плагина в базе-->
    <?php
        echo '<pre>';
        var_dump( get_option( PREFIX . 'option' ) );
        echo '</pre>';
    ?>
</div>