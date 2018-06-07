<?php
/*
 Plugin Name: Parcel Vue Bundler
 Plugin URI: http://mondaybynoon.com/parcel-bundle-vue-wordpress-plugin/
 Description: Starter WordPress plugin utilizing Parcel to bundle your Vue application
 Version: 0.0.1
 Author: Jonathan Christopher
 Author URI: https://mondaybynoon.com/
 Text Domain: parcelvuebundler
*/

/*  Copyright 2018 Jonathan Christopher (email : jonathan@mondaybynoon.com)

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
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class ParcelVueBundler {
	private $version = '0.0.1';
	private $slug = 'parcel-vue-bundler';

	function __construct() {

	}

	function init() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );
	}

	/**
	 * Adds 'Parcel Vue Bundle' entry to the WordPress Admin Menu under Settings
	 * Also outputs our parent element for our Vue application
	 */
	function admin_menu() {
		add_options_page(
			__( 'Parcel Vue Bundle', 'parcelvuebundler' ),
			__( 'Parcel Vue Bundle', 'parcelvuebundler' ),
			'manage_options',
			$this->slug,
			function () { ?>
				<div id="<?php echo esc_attr( 'parcel-vue-bundler-app' ); ?>"></div>
			<?php }
		);
	}

	/**
	 * Enqueue our Parcel-bundled assets on our settings screen
	 */
	function assets( $hook ) {
		// Only output on this plugin's page
		if ( 'settings_page_' . $this->slug !== $hook ) {
			return;
		}

		$debug = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG === true ) || ( isset( $_GET['script_debug'] ) ) ? '' : '.min';

		wp_enqueue_script(
			$this->slug,
			plugin_dir_url( __FILE__ ) . "assets/js/dist/bundle${debug}.js",
			array(),
			$this->version,
			true
		);

		wp_enqueue_style(
			$this->slug,
			plugin_dir_url( __FILE__ ) . "assets/js/dist/bundle${debug}.css",
			array(),
			$this->version
		);
	}
}

// Kickoff!
$parcel_vue_bundler = new ParcelVueBundler();
$parcel_vue_bundler->init();
