<?php

/**
 * Mozlv_Loader_Interface
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
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
