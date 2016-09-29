<?php

/**
 * Thunderbird product class.
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
 */
class Mozlv_Product_Thunderbird extends Mozlv_Product_Class {

	protected $resource_URL = 'https://product-details.mozilla.org/1.0/thunderbird_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'LATEST_THUNDERBIRD_VERSION',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://download.mozilla.org/?product=thunderbird-%1$s-ssl&os=%3$s&lang=%2$s';
	protected $langpack_URL = 'http://download.cdn.mozilla.net/pub/mozilla.org/thunderbird/releases/%1$s/win32/xpi/%2$s.xpi';
	protected $changelog_URL = 'https://www.mozilla.org/%2$s/thunderbird/%1$s/releasenotes/';
	protected $requirements_URL = 'https://www.mozilla.org/%2$s/thunderbird/%1$s/system-requirements/';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

}
