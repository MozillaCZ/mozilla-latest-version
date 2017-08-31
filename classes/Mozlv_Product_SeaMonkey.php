<?php

/**
 * SeaMonkey product class.
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
 */
class Mozlv_Product_SeaMonkey extends Mozlv_Product_Class {

	protected $resource_URL = 'https://www.seamonkey-project.org/seamonkey_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'LATEST_SEAMONKEY_VERSION',
										'beta' => 'LATEST_SEAMONKEY_MILESTONE_VERSION',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://download.mozilla.org/?product=seamonkey-%1$s&os=%3$s&lang=%2$s';
	protected $langpack_URL = 'https://ftp.mozilla.org/pub/seamonkey/releases/%1$s/win32/xpi/%2$s.xpi';
	protected $changelog_URL = 'https://www.seamonkey-project.org/releases/seamonkey%1$s/';
	protected $requirements_URL = 'https://www.seamonkey-project.org/doc/system-requirements';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

}
