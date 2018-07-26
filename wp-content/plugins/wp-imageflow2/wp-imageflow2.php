<?php
/*
Plugin Name: WP Flow Plus
Plugin URI: http://www.wpflowplus.spiffyplugins.ca
Description: Flow style carousel with Lightbox popups
Version: 3.0.3
Author: Spiffy Plugins
Author URI: http://www.spiffyplugins.ca
Text Domain: wp-imageflow2
Domain Path: /languages

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (!class_exists("WPFlowPlus")) {
Class WPFlowPlus
{
	public function __construct() {
		define ('WPFP_OPTIONS_NAME', 'wpimageflow2_options');
		define ('WPIF2_PLUGIN_URL', plugin_dir_url( __FILE__ ));
		define ('WPIF2_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

		global $wp_version;
		if (!version_compare($wp_version, '2.8.4', '>='))
		{
			add_action ('admin_notices', array($this, 'version_error') );
			return;
		}	
		
		// Includes
		require_once ('includes/class_render.php');
		
		if ( is_admin() ) {
			require_once ('includes/shortcode-buttons.php');
			require_once ('includes/admin/class_admin.php');
			
			$this->admin = new WPFlowPlus_Admin();
		}
		
		// Initialize classes
		$this->render = new WPFlowPlus_Render();
		
		// Hooks and actions
		add_action('init', array($this, 'action_on_init'));
		register_activation_hook( __FILE__, array($this, 'activate'));
		register_deactivation_hook( __FILE__, array($this, 'deactivate'));
		add_action('wp_enqueue_scripts', array($this, 'addScripts'));	
	}
	
	function activate() {
		/*
		** Nothing needs to be done for now
		*/
	}
	
	function deactivate() {
		/*
		** Nothing needs to be done for now
		*/
	}			
	
	function action_on_init() {
		// Localization
		load_plugin_textdomain('wp-imageflow2', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	
	function addScripts() {
		
		global $wp_styles;
	
		wp_enqueue_style( 'wpflowpluscss',  WPIF2_PLUGIN_URL . 'css/screen.css');
		wp_enqueue_style( 'wpflowplus-ie8', WPIF2_PLUGIN_URL . 'css/ie8.css');
		$wp_styles->add_data( 'wpflowplus-ie8', 'conditional', 'IE 8' );
		wp_enqueue_script('wpif2_flowplus', WPIF2_PLUGIN_URL . '/js/imageflowplus.js', array('jquery'), 
						filemtime( WPIF2_PLUGIN_DIR . 'js/imageflowplus.js') );
	}		


	function getAdminOptions() {
		/*
		** Merge default options with the saved values
		*/
		$use_options = array(	'gallery_url' => '0', 	// Path to gallery folders when not using built in gallery shortcode
						'bgcolor' 	 => '#000000',	// Background color defaults to black
						'txcolor' 	 => '#ffffff',	// Text color defaults to white
						'slcolor' 	 => 'white',	// Slider color defaults to white
						'width'   	 => '520px',	// Width of containing div
						'aspect'  	 => '1.9',		// Aspect ratio of containing div
						'reflect' 	 => 'CSS',		// CSS, or none
						'autorotate' => 'off',		// True to enable auto rotation
						'pause'  	 =>'3000',		// Time to pause between auto rotations
						'samewindow' => false,		// True to open links in same window rather than new window
						'nocaptions' => false,		// True to hide captions in the carousel
						'noslider'	 => false,		// True to hide the scrollbar
						'imgsize'	 => 'medium'	// Default carousel image size
					);
		$saved_options = get_option(WPFP_OPTIONS_NAME);
		if (!empty($saved_options)) {
			foreach ($saved_options as $key => $option)
				$use_options[$key] = $option;
		}

		// Transparent background no longer supported
		if ($use_options['bgcolor'] == 'transparent') $use_options['bgcolor'] = '#000000';
		
		// Reflection scripts no longer supported
		if (($use_options['reflect'] != 'CSS') && ($use_options['reflect'] != 'none')) $use_options['reflect'] = 'CSS';
		
		return $use_options;
	}
	

	/*
	** Determine the path to a gallery specified by url
	*/
	public static function get_path($gallery_url) {
		/*
		** Determine the path to prepend with DOCUMENT_ROOT
		*/
		if (substr($gallery_url, 0, 7) != "http://") return $gallery_url;

		$dir_array = parse_url($gallery_url);
		return $dir_array['path'];
	}

	/*
	** Display version error message
	*/
	function version_error () {
		echo '<div class="error">' . __('WP Flow Plus requires at least WordPress 2.8.4','wp-imageflow2') . '</div>';
	}	
}
}

if (class_exists("WPFlowPlus")) {
	$wpimageflow2 = new WPFlowPlus();
}
?>