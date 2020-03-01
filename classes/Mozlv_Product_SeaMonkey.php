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
	protected $langpack_URL = 'https://ftp.mozilla.org/pub/seamonkey/releases/%1$s/langpack/seamonkey-%1$s.%2$s.langpack.xpi';
	protected $changelog_URL = 'https://www.seamonkey-project.org/releases/seamonkey%1$s/';
	protected $requirements_URL = 'https://www.seamonkey-project.org/doc/system-requirements';

	protected function get_loader() {
		return Mozlv_Loader_JSON::getInstance();
	}

	protected function get_latest_url( $url, $channel, $platform ) {
		if ( $url == $this->download_URL ) {
			switch ( $platform ) {
				case 'win':
					return parent::get_latest_url( 'https://archive.mozilla.org/pub/seamonkey/releases/%1$s/win32/%2$s/seamonkey-%1$s.%2$s.win32.installer.exe', $channel, $platform );
				case 'win64':
					return parent::get_latest_url( 'https://archive.mozilla.org/pub/seamonkey/releases/%1$s/win64/%2$s/seamonkey-%1$s.%2$s.win64.installer.exe', $channel, $platform );
				case 'mac':
					return parent::get_latest_url( 'https://archive.mozilla.org/pub/seamonkey/releases/%1$s/mac/%2$s/seamonkey-%1$s.%2$s.mac.dmg', $channel, $platform );
				case 'lin':
					return parent::get_latest_url( 'https://archive.mozilla.org/pub/seamonkey/releases/%1$s/linux-i686/%2$s/seamonkey-%1$s.%2$s.linux-i686.tar.bz2', $channel, $platform );
				case 'lin64':
					return parent::get_latest_url( 'https://archive.mozilla.org/pub/seamonkey/releases/%1$s/linux-x86_64/%2$s/seamonkey-%1$s.%2$s.linux-x86_64.tar.bz2', $channel, $platform );
			}
		}
		return parent::get_latest_url( $url, $channel, $platform );
	}
}
