<?php

//common slag scloader_

// add option page to the admin menu
function scloader_option_admin_menu() {
    add_options_page( 'SC loader Options', 'Loader Options', 'manage_options', 'scloader_options.php', 'scloader_main_callbk_function' );
    
    //Activating custom setting
    add_action('admin_init', 'scloader_custom_settings');
    
}
add_action( 'admin_menu', 'scloader_option_admin_menu' );


// custom setting callback function
function scloader_custom_settings(){
    
    //registering settings
    register_setting( 'scloader-settings-group', 'background_color');
    register_setting( 'scloader-settings-group', 'background_color');
    
    //settings sections 
    add_settings_section( 'scloader-genarel-section', 'Color Section', 'genarel_section_callback', 'scloader_options.php' );
    
    //adding setting fields
    add_settings_field( 'scloader-background-color', 'Background Color', 'background_color_field_callback', 'scloader_options.php', 'scloader-genarel-section' );
    
}


// section callbacks
function genarel_section_callback(){
    echo 'customize all colors';
}

// option fields callback
function background_color_field_callback(){
    $backgroundColor = esc_attr( get_option( 'background_color' ) );
    echo '<input type="color" name="background_color" value="'.$backgroundColor.'"/>';
}



// callback function
function scloader_main_callbk_function(){  ?>
   
   
    <div class="wrap">
        <h1 class="title">SC Loader Options</h1>
        <?php settings_errors('scloader_options.php'); ?>
        <form method="post" action="options.php">
            <?php settings_fields( 'scloader-settings-group' ); ?>
            <?php do_settings_sections( 'scloader_options.php' ); ?>
            <?php submit_button(); ?>
        </form>
        
    </div>
    
    
    
    
    
    
    
    
<?php }