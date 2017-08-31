<?php

/**
 * Firefox for Android product class.
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
 */
class Mozlv_Product_Mobile extends Mozlv_Product_Class {

	protected $resource_URL = 'https://product-details.mozilla.org/1.0/mobile_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'version',
										'beta' => 'beta_version',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://play.google.com/store/apps/details?id=org.mozilla.firefox';
	protected $langpack_URL = '';
	protected $changelog_URL = 'https://www.mozilla.org/%2$s/mobile/%1$s/releasenotes/';
	protected $requirements_URL = 'https://support.mozilla.org/kb/will-firefox-work-my-mobile-device';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

	protected function get_latest_url( $url, $channel, $platform ) {
		if ( $url == $this->download_URL && ( $channel == 'beta' ) ) {
			return parent::get_latest_url( 'https://play.google.com/store/apps/details?id=org.mozilla.firefox_beta', $channel, $platform );
		} else {
			return parent::get_latest_url( $url, $channel, $platform );
		}
	}
}
