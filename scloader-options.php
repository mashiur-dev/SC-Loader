<?php

//common slag scloader_

// add option page to the admin menu
function scloader_option_admin_menu() {
    add_options_page( 'SC loader Options', 'Loader Options', 'manage_options', 'scloader_options.php', 'scloader_main_callbk_function' );
    
    //Activating custom setting
    add_action( 'admin_init', 'scloader_custom_settings' );
    
}
add_action( 'admin_menu', 'scloader_option_admin_menu' );


// custom setting callback function
function scloader_custom_settings(){
    
    //registering settings with group-id
    register_setting( 'scloader-settings-group', 'select-loader');
    
    //settings sections 
    add_settings_section( 'scloader-genarel-section', 'General Options', 'genarel_section_callback', 'scloader_options.php' );
    
    //adding setting fields
    add_settings_field( 'scloader-loader-selection', 'Select a loader', 'loader_selection_callback', 'scloader_options.php', 'scloader-genarel-section' );
    
}


// section callbacks
function genarel_section_callback(){
    echo 'customize the loader';
}

// option fields callback

function loader_selection_callback(){
    $selectLoader = get_option( 'select-loader' );
    ?>
    
    <div class="loader_selection_div">
       
        <?php for ($x = 1; $x <= 24; $x++) { ?>
            <label>
               <input onchange="loaderselectionChange(this.value)" type="radio" name="select-loader" value="<?php echo $x; ?>" <?php echo checked( $x, $selectLoader, false); ?>> <img src="<?php echo plugins_url( '/loaders/Preloader_'.$x.'.gif', __FILE__ ); ?>" alt="">
            </label>
        <?php } ?>
        
    </div>
    
<?php }

// callback function
function scloader_main_callbk_function(){  ?>
   
    
    <div class="wrap">
       
       
       <!-- Inline style for Live View and Options -->
        <style>

            #scloader_live_view {
              align-items: center;
              background: #fff none repeat scroll 0 0;
              border: 2px solid #ddd;
              display: flex;
              height: 300px;
              justify-content: center;
              max-width: 600px;
              min-width: 300px;
              position: relative;
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
            
            .loader_selection_div {
              max-width: 560px;
            }
            .loader_selection_div > label > input {
              display: none;
            }
            .loader_selection_div > label > img {
                border: 2px solid transparent;
                cursor: pointer;
                max-width: 60px;
            }
            .loader_selection_div > label > input:checked + img {
              border: 2px solid #ddd;
            }
            
            /*Author credit*/
            .scauthor_credit {
                margin: 10px 0;
            }
            .scauthor_credit h2 {
                font-size: 16px;
                margin: 0;
                line-height: 18px;
            }
            .scauthor_credit a {
                text-decoration: none;
                color: #1b1dfc;
            }
            .scauthor_credit a > span {
                border: 1px solid #649e7d;
                color: #232a36;
                font-weight: normal;
                padding: 1px 10px;
                text-transform: uppercase;
                font-size: 14px;
            }
            .scauthor_credit a:hover span {
                background: #649e7d;
                color: #fff;
            }
            .scauthor_credit > p {
                font-size: 14px;
                color: #5d5e5f;
                border-left: 5px solid #ddd;
                padding-left: 10px;
                margin: 0;
            }
            
        </style>
        
        <!-- Line Script for live view -->
        <script>
            function loaderselectionChange(value) {
                var liveLoaderImage = document.getElementById("scloader_live_view_img");
                    liveLoaderImage.src = "<?php echo plugins_url( '/loaders/Preloader_" + value + ".gif', __FILE__ ); ?>";
            }
        </script>
        
        <!-- Live viw for admin -->
        <div id="scloader_live_view">
            <div class="frame">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <img id="scloader_live_view_img" src="<?php echo plugins_url( '/loaders/Preloader_'. get_option( 'select-loader' ) .'.gif', __FILE__ ); ?>">
        </div>
        
        <!-- Options -->
        <h1 class="title">SC Loader Options</h1>
        <?php settings_errors('scloader_options.php'); ?>
        
        <form method="post" action="options.php">
            <?php settings_fields( 'scloader-settings-group' ); ?>
            <div class="scauthor_credit">
                <h2>Developed by <a href="#">Mashiur Rahman <span>Hire Now!</span></a></h2>
                <p>Available for freelance work!</p>
            </div>
            <?php do_settings_sections( 'scloader_options.php' ); ?>
            <?php submit_button(); ?>
        </form>
        
    </div>
    
    
    
    
<?php }