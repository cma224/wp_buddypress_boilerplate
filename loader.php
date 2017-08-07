<?php
/*
Plugin Name: BuddyPress Boilerplate
Description: This plugin serves as a template for the development of other BuddyPress plugins.
Version: 1.0.0
Author: Cristian Abello
Author URI: mailto:cristian.abello@valpo.edu
License: GNU AGPL
*/

class BuddyPress_Extension{

    function __construct() {
        
    	// Define plugin constants
		$this->basename       = plugin_basename( __FILE__ );
		$this->directory_path = plugin_dir_path( __FILE__ );
		$this->directory_url  = plugins_url( dirname( $this->basename ) );
        
        // Run our activation and deactivation hooks
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
    
        // If BuddyPress is unavailable, deactivate our plugin
		add_action( 'admin_notices', array( $this, 'maybe_disable_plugin' ) );
		
		// Include our other plugin files
		add_action( 'init', array( $this, 'includes' ) );
    
    }
    
    public function includes() {
        // Include files
        

        // Add files individually later on in like so:
        //require_once( $this->directory_path . '../includes/sample.php' );
        
    }
    
    public function activate() {
        // Fun activation stuff
    }
    
    public function deactivate() {
        // Fun deactivation stuff
    }
    
    public static function meets_requirements() {
        
        // class_exists checks that BuddyPress is ACTIVE
        if(class_exists('BuddyPress'))
            return true;
        else
            return false;
        
        
    }
    
    public function maybe_disable_plugin() {
        		
        	if ( ! $this->meets_requirements() ) {
    		
    		// Display our error
    		echo '<div id="message" class="error">';
    		echo '<p>' . sprintf( __( 'This plugin requires BuddyPress and has been <a href="%s">deactivated</a>. Please install and activate BuddyPress and then reactivate this plugin.', 'sample-addon' ), admin_url( 'plugins.php' ) ) . '</p>';
    		echo '</div>';
    
    		// Deactivate our plugin
    		deactivate_plugins( $this->basename );
    			
    		// Stop WordPress from displaying "Plugin Activated" message.
    		if ( isset( $_GET['activate'] ) ) 
                unset( $_GET['activate'] );
                
        }
    
    }

}

$GLOBALS['buddypress_extension'] = new BuddyPress_Extension();

?>