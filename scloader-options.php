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
    register_setting( 'scloader-settings-group', 'select-loader');
    
    //settings sections 
    add_settings_section( 'scloader-genarel-section', 'General Options', 'genarel_section_callback', 'scloader_options.php' );
    
    //adding setting fields
    add_settings_field( 'scloader-background-color', 'Background Color', 'background_color_field_callback', 'scloader_options.php', 'scloader-genarel-section' );
    add_settings_field( 'scloader-loader-selection', 'Select loader', 'loader_selection_callback', 'scloader_options.php', 'scloader-genarel-section' );
    
}


// section callbacks
function genarel_section_callback(){
    echo 'customize the loader';
}

// option fields callback
function background_color_field_callback(){
    $backgroundColor = esc_attr( get_option( 'background_color' ) );
    echo '<input type="color" name="background_color" value="'.$backgroundColor.'"/>';
}

function loader_selection_callback(){
    $selectLoader = get_option( 'select-loader' );
    ?>
    <input onchange="loaderselectionChange(this.value)" type="radio" name="select-loader" value="1" <?php echo checked( 1, $selectLoader, false); ?>> <img src="<?php echo plugins_url( '/loaders/flat/Preloader_1.gif', __FILE__ ); ?>" alt="">
    
    <input onchange="loaderselectionChange(this.value)" type="radio" name="select-loader" value="2" <?php echo checked( 2, $selectLoader, false); ?>> <img src="<?php echo plugins_url( '/loaders/flat/Preloader_2.gif', __FILE__ ); ?>" alt="">
    
    <input onchange="loaderselectionChange(this.value)" type="radio" name="select-loader" value="3" <?php echo checked( 3, $selectLoader, false); ?>> <img src="<?php echo plugins_url( '/loaders/flat/Preloader_3.gif', __FILE__ ); ?>" alt="">
    
    <input onchange="loaderselectionChange(this.value)" type="radio" name="select-loader" value="4" <?php echo checked( 4, $selectLoader, false); ?>> <img src="<?php echo plugins_url( '/loaders/flat/Preloader_4.gif', __FILE__ ); ?>" alt="">
    
    
<?php }



// callback function
function scloader_main_callbk_function(){  ?>
   
    
    <div class="wrap">
        <style>
            #scloader_live_view {
              align-items: center;
              background: #fff none repeat scroll 0 0;
              border: 2px solid #ddd;
              display: flex;
              height: 300px;
              justify-content: center;
              max-width: 600px;
              min-width: 400px;
              position:relative;
            }
            
            
            #scloader_live_view .frame {
              background: #ddd none repeat scroll 0 0;
              display: block;
              height: 18px;
              left: 0;
              position: absolute;
              top: 0;
              width: 100%;
            }

            #scloader_live_view span {
              background-color: #eee;
              border: 1px solid #dadada;
              border-radius: 8px;
              float: left;
              height: 8px;
              margin: 3px 0 0 4px;
              width: 8px;
            }
        </style>

        <div id="scloader_live_view">
            <div class="frame">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <img id="scloader_live_view_img" src="<?php echo plugins_url( '/loaders/flat/Preloader_'. get_option( 'select-loader' ) .'.gif', __FILE__ ); ?>">
        </div>
        
        <h1 class="title">SC Loader Options</h1>
        <?php settings_errors('scloader_options.php'); ?>
        <form method="post" action="options.php">
            <?php settings_fields( 'scloader-settings-group' ); ?>
            <?php do_settings_sections( 'scloader_options.php' ); ?>
            <?php submit_button(); ?>
        </form>
        
        
        <script>

        function loaderselectionChange(value) {
            var liveLoaderImage = document.getElementById("scloader_live_view_img");
                liveLoaderImage.src = "<?php echo plugins_url( '/loaders/flat/Preloader_" + value + ".gif', __FILE__ ); ?>";
        }
        
        </script>
        
    </div>
    
    
    
    
<?php }