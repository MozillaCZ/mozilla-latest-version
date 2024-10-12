<?php

/**
 * Focus for iOS
 */
class Mozlv_Product_Focus_iOS extends Mozlv_Product_Class {

	protected $resource_URL = 'https://product-details.mozilla.org/1.0/mobile_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'ios_version',
										'beta' => 'ios_beta_version',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://apps.apple.com/app/firefox-focus-privacy-browser/id1055677337';
	protected $langpack_URL = '';
	protected $changelog_URL = '';
	protected $requirements_URL = 'https://support.mozilla.org/products/focus-firefox/Focus-ios';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

	protected function get_latest_url( $url, $channel, $platform ) {
		if ( $url == $this->download_URL ) {
			if ( $channel == 'beta' ) {
				return 'https://testflight.apple.com/join/dH8lkFZi';
			}
		}
		return parent::get_latest_url( $url, $channel, $platform );
	}
}
