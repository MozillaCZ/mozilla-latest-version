<?php

/**
 * Focus for Android
 */
class Mozlv_Product_Focus_Android extends Mozlv_Product_Class {

	protected $resource_URL = 'https://product-details.mozilla.org/1.0/mobile_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'version',
										'beta' => 'beta_version',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://play.google.com/store/apps/details?id=org.mozilla.focus&hl=%2$s';
	protected $langpack_URL = '';
	protected $changelog_URL = '';
	protected $requirements_URL = 'https://support.mozilla.org/products/focus-firefox/firefox-focus-android';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

	protected function get_latest_url( $url, $channel, $platform ) {
		if ( $url == $this->download_URL ) {
			if ( $channel == 'beta' ) {
				return parent::get_latest_url( 'https://play.google.com/store/apps/details?id=org.mozilla.focus.beta&hl=%2$s', $channel, $platform );
			}
		}
		return parent::get_latest_url( $url, $channel, $platform );
	}
}
