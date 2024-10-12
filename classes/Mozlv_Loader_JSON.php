<?php

/**
 * Mozlv_Loader_JSON handles loading and validating JSON from remote server (or cache).
 */
class Mozlv_Loader_JSON implements Mozlv_Loader_Interface {

    private static $instance = NULL;

	public function load_from( $data ) {
		return json_decode( $data, true );
	}

	/**
	 * Loads JSON string from $URL.
	 * 
	 * @param string $URL of the JSON
	 * @return string JSON
	 * @throw Mozlv_Data_Load_Exception if the data cannot be loaded
	 * @throw Mozlv_Invalid_Data_Exception if the loaded data are invalid or cannot be parsed
	 */
	public function load( $URL ) {
		$context = stream_context_create(
			array(
				'http' => array('timeout' => MOZLV_DATA_LOAD_TIMEOUT)
			)
		);
		$json = @file_get_contents( $URL, false, $context );
		if ( $json == false || ! $this->substring_in_array( ' 200 OK', $http_response_header ) ) {
			throw new Mozlv_Data_Load_Exception( 'Cannot load data.' );
		}
		if ( ! $this->is_JSON( $json ) ) {
			throw new Mozlv_Invalid_Data_Exception( 'Loaded data are not valid JSON.' );
		}
		return $json;
	}

	/**
	 * Checks if any $array value contains the specified $substring.
	 * 
	 * @param string $substring to search for
	 * @param array $array to search in
	 * @return boolean true if found
	 */
	private function substring_in_array( $substring, $array ) {
		foreach ( $array as $value ) {
			if ( strpos( $value, $substring ) !== false ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Checks the $string is valid JSON.
	 * 
	 * @param string $string to check
	 * @return boolean true if valid
	 */
	private function is_JSON( $string ) {
		$json = json_decode( $string );
		if ( function_exists( 'json_last_error' ) ) { // json_last_error comes with PHP 5 >= 5.3.0
			return ( json_last_error() == JSON_ERROR_NONE && $json !== NULL );
		} else {
			return $json !== NULL;
		}
	}

	/**
	 * Returns the Mozlv_Loader_JSON singleton instance.
	 */
	public static function getInstance() {
		if ( self::$instance == NULL ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
