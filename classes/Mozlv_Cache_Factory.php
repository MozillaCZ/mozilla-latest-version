<?php

/**
 * Mozlv_Cache_Factory is a static class to get the cache implementation according to the plugin settings.
 *
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class Mozlv_Cache_Factory {

	private static $cache = NULL;

	/**
	 * Returns the cache implementation according to the plugin settings.
	 * 
	 * @return Mozlv_Cache_Interface cache implementation
	 */
	public static function get_cache() {
		if ( self::$cache == NULL ) {
			$mozlv_options = Mozlv_Options::getInstance();
			switch ( $mozlv_options->get_cache_type() ) {
				case $mozlv_options->cache_type_transients_api():
					self::$cache = new Mozlv_Cache_Transients_API();
					break;
				case $mozlv_options->cache_type_files():
					self::$cache = new Mozlv_Cache_File();
					break;
				default:
					self::$cache = new Mozlv_Cache_Transients_API();
					break;
			}
		}
		return self::$cache;
	}

}
