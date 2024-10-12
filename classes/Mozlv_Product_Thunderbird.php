<?php

/**
 * Thunderbird for desktop
 */
class Mozlv_Product_Thunderbird extends Mozlv_Product_Class {

	protected $resource_URL = 'https://product-details.mozilla.org/1.0/thunderbird_versions.json';
	protected $channel_to_resource_index = array (
										'release' => 'LATEST_THUNDERBIRD_VERSION',
										'beta' => 'LATEST_THUNDERBIRD_DEVEL_VERSION',
									);
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL = 'https://download.mozilla.org/?product=thunderbird-%1$s-ssl&os=%3$s&lang=%2$s';
	protected $langpack_URL = 'https://archive.mozilla.org/pub/thunderbird/releases/%1$s/linux-x86_64/xpi/%2$s.xpi';
	protected $changelog_URL = 'https://www.mozilla.org/%2$s/thunderbird/%1$s/releasenotes/';
	protected $requirements_URL = 'https://www.mozilla.org/%2$s/thunderbird/%1$s/system-requirements/';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

	protected function get_latest_url( $url, $channel, $platform ) {
		if ( $url == $this->download_URL ) {
			if ( $platform == 'msstore' && $channel == 'release' ) {
				return 'https://apps.microsoft.com/detail/9pm5vm1s3vmq';
			} else if ( $platform == 'flatpak' && $channel == 'release' ) {
				return 'https://flathub.org/apps/details/org.mozilla.Thunderbird';
			} else if ( $platform == 'snap' && $channel == 'release' ) {
				return 'https://snapcraft.io/thunderbird';
			}
		}
		return parent::get_latest_url( $url, $channel, $platform );
	}
}
