<?php

/**
 * Mozlv_Cache_Transients_API is one of the Mozlv_Cache_Interface implematations, which stores values using WordPress Transients API.
 * 
 * @link https://codex.wordpress.org/Transients_API Transients API « WordPress Codex
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class Mozlv_Cache_Transients_API implements Mozlv_Cache_Interface {

	private $created = '_created';

	public function valid($key) {
		return $this->exists($key) && !($this->expired($key));
	}

	public function get($key) {
		return get_transient($key);
	}

	public function store($key, $value) {
		return set_transient($key, $value) && set_transient($key.$this->created, time());
	}

	public function remove($key) {
		return delete_transient($key) && delete_transient($key.$this->created);
	}

	/**
	 * Checks the value for $key stored in cache exists.
	 * 
	 * @param string $key
	 * @return boolean true if exists
	 */
	private function exists($key) {
		return (bool)(get_transient($key));
	}

	/**
	 * Checks the value for $key stored in cache is expired.
	 * 
	 * @param string $key
	 * @return boolean true if expired
	 */
	private function expired($key) {
		$created = get_transient($key.$this->created);
		return $created && time()-$created > Mozlv_Options::getInstance()->get_cache_expire();
	}

}
