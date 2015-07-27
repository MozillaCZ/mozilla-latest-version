<?php

/**
 * Mozlv_Loader_JSON handles loading and validating JSON from remote server (or cache).
 * 
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
interface Mozlv_Loader_Interface {

	/**
	 * Returns resource array.
	 * 
	 * @param string $URL of the resource
	 * @return array or NULL if cannot be loaded
	 */
	public function get( $URL );

	public function invalidate( $URL );

}
