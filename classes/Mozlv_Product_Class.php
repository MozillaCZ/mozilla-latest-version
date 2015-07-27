<?php

/**
 * Mozlv_Product_Class is an abstract class which has to be extended by all product classes.
 * 
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
abstract class Mozlv_Product_Class {

	protected $resource_URL;
	protected $default_channel = 'release';
	protected $channel_to_resource_index;
	// %1$s will be replaced by the product version
	// %2$s will be replaced by the language
	// %3$s will be replaced by the platform
	protected $download_URL;
	protected $langpack_URL;
	protected $changelog_URL;
	protected $requirements_URL;
	protected $loader = NULL;
	private $version = array();

	/**
	 * Returns latest product version in $channel for $platform.
	 * 
	 * @param string $channel
	 * @param string $platform
	 * @return string product version
	 */
	public function get_latest_version( $channel, $platform = NULL ) {
		if ( $channel == NULL || $channel == '' ) {
			$channel = $this->default_channel;
		}
		try {
			if ( ! isset( $this->version[ $channel ][ $platform ] ) ) {
				$this->version[ $channel ][ $platform ] = $this->get_latest_version_from_loader( $channel );
			}
		} catch ( Mozlv_Invalid_Data_Exception $e ) {
		}
		return $this->version[ $channel ][ $platform ];
	}

	/**
	 * Returns latest product download URL in $channel for $platform.
	 * 
	 * @param string $channel
	 * @param string $platform
	 * @return string product download URL
	 */
	public function get_latest_download_URL( $channel, $platform ) {
		return $this->get_latest_url( $this->download_URL, $channel, $platform );
	}

	/**
	 * Returns latest product language pack download URL in $channel for $platform.
	 * 
	 * @param string $channel
	 * @param string $platform
	 * @return string product language pack download URL
	 */
	public function get_latest_langpack_URL( $channel, $platform ) {
		return $this->get_latest_url( $this->langpack_URL, $channel, $platform );
	}

	/**
	 * Returns latest product changelog URL in $channel for $platform.
	 * 
	 * @param string $channel
	 * @param string $platform
	 * @return string product changelog URL
	 */
	public function get_latest_changelog_URL( $channel, $platform ) {
		return $this->get_latest_url( $this->changelog_URL, $channel, $platform );
	}

	/**
	 * Returns latest product system requirements URL in $channel for $platform.
	 * 
	 * @param string $channel
	 * @param string $platform
	 * @return string product system requirements URL
	 */
	public function get_latest_requirements_URL( $channel, $platform ) {
		return $this->get_latest_url( $this->requirements_URL, $channel, $platform );
	}

	/**
	 * Returns latest product version in $channel.
	 * 
	 * @param string $channel
	 * @return string product version
	 */
	protected function get_latest_version_from_loader( $channel ) {
		if ( $channel == NULL || $channel == '' ) {
			$channel = $this->default_channel;
		}
		$resource_array = $this->loader->get( $this->resource_URL );
		if ( ! isset( $resource_array[ $this->channel_to_resource_index[ $channel ] ] ) && ! isset( $channel ) ) {
			$this->loader->invalidate( $this->resource_URL );
			throw new Mozlv_Invalid_Data_Exception( 'Loaded data are not valid.' );
		}
		return $resource_array[ $this->channel_to_resource_index[ $channel ] ];
	}

	/**
	 * Replaces version, links language and $platform in given $url.
	 * 
	 * @param string $url
	 * @param string $channel
	 * @param string $platform
	 * @return string
	 */
	protected function get_latest_url( $url, $channel, $platform ) {
		if ( $channel == NULL || $channel == '' ) {
			$channel = $this->default_channel;
		}
		switch ( $platform ) {
			case 'win':
				$platform = 'win';
				break;
			case 'win64':
				$platform = 'win64';
				break;
			case 'linux':
			case 'lin':
				$platform = 'linux';
				break;
			case 'linux64':
			case 'lin64':
				$platform = 'linux64';
				break;
			case 'osx':
			case 'mac':
				$platform = 'osx';
				break;
		}
		$version = $this->get_latest_version( $channel, $platform );
		if ( $version != NULL ) {
			return sprintf( $url, $version, Mozlv_Options::getInstance()->get_links_lang(), $platform );
		} else {
			return NULL;
		}
	}

}
