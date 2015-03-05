<?php

interface Mozlv_Cache_Interface {

	public function get($key);

	public function store($key, $value);

	public function remove($key);

}
