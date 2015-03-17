<?php

/**
 * Mozlv_Cache_File is one of the Mozlv_Cache_Interface implematations, which stores values in standalone files in directory defined by MOZLV_CACHE_FILES_DIR.
 * 
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class Mozlv_Cache_File implements Mozlv_Cache_Interface {

	private $cache_dir = MOZLV_CACHE_FILES_DIR;

	public function get($key) {
		if(is_file($this->cache_dir.$key) && time()-filemtime($this->cache_dir.$key) > Mozlv_Options::getInstance()->get_cache_expire()) {
			$this->remove($key);
		}
		if(is_file($this->cache_dir.$key)) {
			return file_get_contents($this->cache_dir.$key);
		} else {
			return false;
		}
	}

	public function store($key, $value) {
		wp_mkdir_p($this->cache_dir);
		return file_put_contents($this->cache_dir.$key, $value);
	}

	public function remove($key) {
		if(is_file($this->cache_dir.$key)) {
			return unlink($this->cache_dir.$key);
		} else {
			return true;
		}
	}

}
