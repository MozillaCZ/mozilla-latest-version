<?php

class Mozlv_JSON_Loader {

	private $cache;

	public function __construct() {
		$this->cache = Mozlv_Cache_Factory::get_cache();
	}

	public function get_JSON($URL) {
		try {
			return $this->load_using_cache($URL);
		} catch (Mozlv_Data_Load_Exception $e) {
			return NULL;
		}
	}

	public function invalidate($URL) {
		return $this->cache->remove(basename($URL));
	}

	private function load_using_cache($URL) {
		$in_cache = basename($URL);
		if($this->cache->get($in_cache)) {
			$json = $this->cache->get($in_cache);
		} else {
			try {
				$json = $this->load_directly($URL);
				$this->cache->store($in_cache, $json);
			} catch (Exception $e) {
				if($this->cache->get($in_cache)) {
					$json = $this->cache->get($in_cache);
				} else {
					throw $e;
				}
			}
		}
		return $json;
	}

	private function load_directly($URL) {
		$json = file_get_contents($URL);
		if(!$this->substring_in_array(' 200 OK', $http_response_header)) {
			throw new Mozlv_Data_Load_Exception('Cannot load data.');
		}
		if(!$this->is_JSON($json)) {
			throw new Invalid_Data_Exception('Loaded data are not valid JSON.');
		}
		return $json;
	}

	private function substring_in_array($substring, $array) {
		foreach($array as $value) {
			if(strpos($value, $substring) !== false) {
				return true;
			}
		}
		return false;
	}

	private function is_JSON($string) {
		$json = json_decode($string);
		if (function_exists('json_last_error')) { // json_last_error comes with PHP 5 >= 5.3.0
			return (json_last_error() == JSON_ERROR_NONE && $json !== NULL);
		} else {
			return $json !== NULL;
		}
	}

}
