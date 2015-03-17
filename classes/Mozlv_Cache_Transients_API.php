<?php

/**
 * Mozlv_Cache_Transients_API is one of the Mozlv_Cache_Interface implematations, which stores values using WordPress Transients API.
 * 
 * @link https://codex.wordpress.org/Transients_API Transients API « WordPress Codex
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class Mozlv_Cache_Transients_API implements Mozlv_Cache_Interface {

	private $created = '_created';

	public function get($key) {
		$created = get_transient($key.$this->created); 
		if($created == false || time()-$created > Mozlv_Options::getInstance()->get_cache_expire()) {
			$this->remove($key);
		}
		return get_transient($key);
	}

	public function store($key, $value) {
		$expire = Mozlv_Options::getInstance()->get_cache_expire();
		return set_transient($key, $value, $expire) && set_transient($key.$this->created, time(), $expire);
	}

	public function remove($key) {
		return delete_transient($key) && delete_transient($key.$this->created);
	}

}
