<?php
/**
* Plugin Name: DJ Rotator
* Plugin URI:  http://gregrickaby.com
* Description: Schedule and rotate DJ's on your WordPress web site
* Version:     2.0
* Author:      Greg Rickaby dESIGN
* Author URI:  http://gregrickaby.com
* Donate link: http://gregrickaby.com
* License:     GPLv2
* Text Domain: dj-rotator
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2015 Greg Rickaby dESIGN (email : greg@gregrickaby.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using generator-plugin-wp
 */


// User composer autoload.
require 'vendor/autoload_52.php';


/**
 * Main initiation class
 */
class DJ_Rotator {

	const VERSION = '2.0';

	protected $url      = '';
	protected $path     = '';
	protected $basename = '';
	protected static $single_instance = null;

	/**
	 * Creates or returns an instance of this class.
	 * @since  0.1.0
	 * @return DJ_Rotator A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin
	 * @since  2.0
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );

		$instance->plugin_classes();
		$instance->hooks();
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 * @since 2.0
	 */
	function plugin_classes() {
		// Attach other plugin classes to the base plugin class.
		// $this->admin = new DJR_Admin( $this );
	}

	/**
	 * Add hooks and filters
	 * @since 2.0
	 */
	public function hooks() {
		register_activation_hook( __FILE__, array( $this, '_activate' ) );
		register_deactivation_hook( __FILE__, array( $this, '_deactivate' ) );

		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Activate the plugin
	 * @since  2.0
	 */
	function _activate() {
		// Make sure any rewrite functionality has been loaded
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 * @since  2.0
	 */
	function _deactivate() {}

	/**
	 * Init hooks
	 * @since  2.0
	 * @return null
	 */
	public function init() {
		if ( $this->check_requirements() ) {
			$locale = apply_filters( 'plugin_locale', get_locale(), 'dj-rotator' );
			load_textdomain( 'dj-rotator', WP_LANG_DIR . '/dj-rotator/dj-rotator-' . $locale . '.mo' );
			load_plugin_textdomain( 'dj-rotator', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
	}

	/**
	 * Check that all plugin requirements are met
	 * @since  2.0
	 * @return boolean
	 */
	public static function meets_requirements() {
		// Do checks for required classes / functions
		// function_exists('') & class_exists('')

		// We have met all requirements
		return true;
	}

	/**
	 * Check if the plugin meets requirements and
	 * disable it if they are not present.
	 * @since  2.0
	 * @return boolean result of meets_requirements
	 */
	public function check_requirements() {
		if ( ! $this->meets_requirements() ) {
			// Display our error
			echo '<div id="message" class="error">';
			echo '<p>' . sprintf( __( 'DJ Rotator is missing requirements and has been <a href="%s">deactivated</a>. Please make sure all requirements are available.', 'dj-rotator' ), admin_url( 'plugins.php' ) ) . '</p>';
			echo '</div>';
			// Deactivate our plugin
			deactivate_plugins( $this->basename );

			return false;
		}

		return true;
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  2.0
	 * @param string $field
	 * @throws Exception Throws an exception if the field is invalid.
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
				return $this->$field;
			default:
				throw new Exception( 'Invalid '. __CLASS__ .' property: ' . $field );
		}
	}
}

/**
 * Grab the DJ_Rotator object and return it.
 * Wrapper for DJ_Rotator::get_instance()
 */
function dj_rotator() {
	return DJ_Rotator::get_instance();
}

// Kick it off
dj_rotator();
