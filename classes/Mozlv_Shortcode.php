<?php

/**
 * Mozlv_Shortcode contains all functions neccessary to handle the shortcodes.
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
 */
class Mozlv_Shortcode {

	/**
	 * Returns latest product version in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product version
	 */
	public static function get_latest_version( $atts ) {
		$atts = self::mozlv_atts( $atts );
		$product_class = Mozlv_Product_Factory::get_product( $atts['product'] );
		if ( $product_class == NULL ) {
			return;
		}
		return htmlspecialchars( $product_class->get_latest_version( $atts['channel'] ) );
	}

	/**
	 * Returns latest product download URL in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product download URL or <a> link
	 */
	public static function get_latest_download_URL( $atts ) {
		$atts = self::mozlv_atts( $atts );
		$product_class = Mozlv_Product_Factory::get_product( $atts['product'] );
		if ( $product_class == NULL ) {
			return;
		}
		return $product_class->get_latest_download_URL( $atts['channel'], $atts['platform'] );
	}

	/**
	 * Returns latest product language pack download URL in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product language pack download URL or <a> link
	 */
	public static function get_latest_langpack_URL( $atts ) {
		$atts = self::mozlv_atts( $atts );
		$product_class = Mozlv_Product_Factory::get_product( $atts['product'] );
		if ( $product_class == NULL ) {
			return;
		}
		return $product_class->get_latest_langpack_URL( $atts['channel'], $atts['platform'] );
	}

	/**
	 * Returns latest product changelog URL in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product changelog URL or <a> link
	 */
	public static function get_latest_changelog_URL( $atts ) {
		$atts = self::mozlv_atts( $atts );
		$product_class = Mozlv_Product_Factory::get_product( $atts['product'] );
		if ( $product_class == NULL ) {
			return;
		}
		return $product_class->get_latest_changelog_URL( $atts['channel'], $atts['platform'] );
	}

	/**
	 * Returns latest product system requirements URL in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product system requirements URL or <a> link
	 */
	public static function get_latest_requirements_URL( $atts ) {
		$atts = self::mozlv_atts( $atts );
		$product_class = Mozlv_Product_Factory::get_product( $atts['product'] );
		if ( $product_class == NULL ) {
			return;
		}
		return $product_class->get_latest_requirements_URL( $atts['channel'], $atts['platform'] );
	}

	/**
	 * Fix shortcode attributes.
	 * 
	 * @param array $atts shortcode attributes
	 * @return array $atts shortcode attributes
	 */
	private static function mozlv_atts( $atts ) {
		$atts = shortcode_atts(
			array(
				'product'  => NULL,
				'platform' => NULL,
				'channel'  => NULL,
			),
			$atts
		);
		return $atts;
	}

}
