<?php

/**
 * Mozlv_Shortcode contains all functions neccessary to handle the shortcodes.
 * 
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class Mozlv_Shortcode {

	private static $instance = NULL;

	/**
	 * Returns latest product version in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product version
	 */
	public function get_latest_version($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_version($atts['channel'], $atts['platform']));
	}

	/**
	 * Returns latest product download URL in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product download URL
	 */
	public function get_latest_download_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_download_URL($atts['channel'], $atts['platform']));
	}

	/**
	 * Returns latest product language pack download URL in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product language pack download URL
	 */
	public function get_latest_langpack_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_langpack_URL($atts['channel'], $atts['platform']));		
	}

	/**
	 * Returns latest product changelog URL in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product changelog URL
	 */
	public function get_latest_changelog_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_changelog_URL($atts['channel'], $atts['platform']));
	}

	/**
	 * Returns latest product system requirements URL in channel for platform.
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product system requirements URL
	 */
	public function get_latest_requirements_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_requirements_URL($atts['channel'], $atts['platform']));
	}

	/**
	 * Returns latest product version in channel for platform (for Mozilla.sk CMS Plugin compatibility).
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product version
	 */
	public function moz_download_version_handler($atts) {
		$atts = self::mozsk_atts($atts);
		return self::get_latest_version($atts);
	}

	/**
	 * Returns latest product download URL in channel for platform (for Mozilla.sk CMS Plugin compatibility).
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product download URL
	 */
	public function moz_download_url_handler($atts) {
		$atts = self::mozsk_atts($atts);
		if ($atts == NULL) {
			return;
		}
		if($atts['platform'] == 'port') {
			return self::get_latest_langpack_URL($atts);
		} else {
			return self::get_latest_download_URL($atts);
		}
	}

	/**
	 * Returns latest product changelog/release notes URL in channel for platform (for Mozilla.sk CMS Plugin compatibility).
	 * 
	 * @param array $atts shortcode attributes
	 * @return string product changelog URL
	 */
	public function moz_download_rn_handler($atts) {
		$atts = self::mozsk_atts($atts);
		return self::get_latest_changelog_URL($atts);
	}

	/**
	 * Get product class for shortcode attributes.
	 * 
	 * @param array $atts shortcode attributes
	 * @return Mozlv_Product_Class
	 */
	private function get_product_class_for_shortcode($atts) {
		$atts = shortcode_atts(
			array('product' => NULL,
				  'platform' => NULL,
				  'channel' => NULL,
			),
			$atts
		);
		return Mozlv_Product_Factory::get_product($atts['product']);
	}

	/**
	 * Fix shortcode attributes for Mozilla.sk CMS Plugin compatibility.
	 * 
	 * @param array $atts shortcode attributes
	 * @return array $atts shortcode attributes
	 */
	private function mozsk_atts($atts) {
		$atts = shortcode_atts(
			array('app' => NULL,
				  'platform' => NULL,
				  'channel' => NULL,
			),
			$atts
		);
		$atts['product'] = $atts['app'];
		return $atts;
	}

	/**
	 * Returns the Mozlv_Shortcode singleton instance.
	 */
	private static function getInstance() {
		if(self::$instance == NULL) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {}

}
