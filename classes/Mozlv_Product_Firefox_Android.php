<?php

/**
 * Firefox for Android
 */
class Mozlv_Product_Firefox_Android extends Mozlv_Product_Class {

	protected $resource_URL = 'https://product-details.mozilla.org/1.0/mobile_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'version',
										'beta' => 'beta_version',
										'nightly' => 'nightly_version',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://play.google.com/store/apps/details?id=org.mozilla.firefox&hl=%2$s';
	protected $langpack_URL = '';
	protected $changelog_URL = 'https://www.mozilla.org/%2$s/mobile/%1$s/releasenotes/';
	protected $requirements_URL = 'https://support.mozilla.org/kb/will-firefox-work-my-mobile-device';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

	protected function get_latest_url( $url, $channel, $platform ) {
		if ( $url == $this->download_URL ) {
			if ( $channel == 'beta' ) {
				return parent::get_latest_url( 'https://play.google.com/store/apps/details?id=org.mozilla.firefox_beta&hl=%2$s', $channel, $platform );
			} else if ( $channel == 'nightly' ) {
				return parent::get_latest_url( 'https://play.google.com/store/apps/details?id=org.mozilla.fenix&hl=%2$s', $channel, $platform );
			}
		}
		return parent::get_latest_url( $url, $channel, $platform );
	}
}
