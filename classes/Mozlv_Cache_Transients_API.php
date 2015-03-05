<?php

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
