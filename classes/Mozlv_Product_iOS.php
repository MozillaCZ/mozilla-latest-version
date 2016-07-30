<?php

/**
 * Firefox for iOS product class.
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
 */
class Mozlv_Product_iOS extends Mozlv_Product_Class {

	protected $resource_URL = 'https://product-details.mozilla.org/1.0/mobile_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'ios_version',
										'beta' => 'ios_beta_version',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://itunes.apple.com/%2$s/app/firefox-web-browser/id989804926';
	protected $langpack_URL = '';
	protected $changelog_URL = 'https://www.mozilla.org/%2$s/firefox/ios/%1$s/releasenotes/';
	protected $requirements_URL = 'https://support.mozilla.org/kb/firefox-available-iphone-or-ipad-my-language';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

}
