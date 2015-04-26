<?php
/**
 * undefined Frontend
 * @version 2.0
 * @package 
 */

class undefinedFrontend {
	/**
	 * Parent plugin class
	 * @var class
	 */
	protected $plugin = null;

	/**
	 * Constructor
	 * @since 2.0
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks
	 * @since 2.0
	 */
	public function hooks() {
	}
}