<?php

/**
 * Mozlv_Options is singleton handling the plugin options and its installation.
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
 */
class Mozlv_Options {

	private static $instance = NULL;
	private $option_group = 'mozlv-option-group';
	private $cache_type = 'mozlv_cache_type';
	private $cache_type_transients_api = 'transients_api';
	private $cache_type_files = 'files';
	private $cache_expire = 'mozlv_cache_expire';
	private $links_lang = 'mozlv_links_lang';

	/**
	 * Handles the plugin installation and its options registration (including default values).
	 */
	public function install() {
		$mozlv_options = self::getInstance();
		add_option( $mozlv_options->cache_type, $mozlv_options->cache_type_transients_api );
		add_option( $mozlv_options->cache_expire, 3600 );
		add_option( $mozlv_options->links_lang, 'en-US' );
	}

	/**
	 * Registers the plugin settings.
	 */
	public function register_settings() {
		$mozlv_options = self::getInstance();
		register_setting( $mozlv_options->option_group, $mozlv_options->cache_type );
		register_setting( $mozlv_options->option_group, $mozlv_options->cache_expire );
		register_setting( $mozlv_options->option_group, $mozlv_options->links_lang );
	}

	/**
	 * Registers the plugin page in the admin menu.
	 */
	public function add_menu() {
		add_options_page(
			'MOZLV Settings',
			'MOZLV Settings',
			'manage_options',
			'Mozlv_Settings_Page.php',
			array( new Mozlv_Settings_Page( self::getInstance()->option_group ), 'main' )
		);
	}

	/**
	 * Returns cache type option identification.
	 */
	public function cache_type() {
		return $this->cache_type;
	}

	/**
	 * Returns cache type setting value.
	 */
	public function get_cache_type() {
		return get_option( $this->cache_type() );
	}

	/**
	 * Returns TRansients API cache type option identification.
	 */
	public function cache_type_transients_api() {
		return $this->cache_type_transients_api;
	}

	/**
	 * Returns Files cache type option identification.
	 */
	public function cache_type_files() {
		return $this->cache_type_files;
	}

	/**
	 * Returns cache expiration option identification.
	 */
	public function cache_expire() {
		return $this->cache_expire;
	}

	/**
	 * Returns cache expiration value.
	 */
	public function get_cache_expire() {
		return get_option( $this->cache_expire() );
	}

	/**
	 * Returns links language option identification.
	 */
	public function links_lang() {
		return $this->links_lang;
	}

	/**
	 * Returns links language setting value.
	 */
	public function get_links_lang() {
		return get_option( $this->links_lang() );
	}

	/**
	 * Returns the Mozlv_Options singleton instance.
	 */
	public static function getInstance() {
		if ( self::$instance == NULL ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {}

}
