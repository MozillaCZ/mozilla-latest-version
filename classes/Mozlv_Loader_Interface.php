<?php

interface Mozlv_Loader_Interface {

	/**
	 * Returns resource array.
	 * 
	 * @param string $data to be decoded
	 * @return array or NULL if cannot be loaded
	 */
	public function load_from( $data );

	/**
	 * Loads data string from $URL.
	 * 
	 * @param string $URL of the data
	 * @return string data
	 * @throw Mozlv_Data_Load_Exception if the data cannot be loaded
	 * @throw Mozlv_Invalid_Data_Exception if the loaded data are invalid or cannot be parsed
	 */
	public function load( $URL );
}
