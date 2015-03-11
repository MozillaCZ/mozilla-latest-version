<?php

class Mozlv_Shortcode {

	private static $instance = NULL;

	public function get_latest_version($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_version($atts['channel'], $atts['platform']));
	}

	public function get_latest_download_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_download_URL($atts['channel'], $atts['platform']));
	}

	public function get_latest_langpack_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_langpack_URL($atts['channel'], $atts['platform']));		
	}

	public function get_latest_changelog_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_changelog_URL($atts['channel'], $atts['platform']));
	}

	public function get_latest_requirements_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		if($product_class == NULL) {
			return;
		}
		return htmlspecialchars($product_class->get_latest_requirements_URL($atts['channel'], $atts['platform']));
	}

	public function moz_download_version_handler($atts) {
		$atts = self::mozsk_atts($atts);
		return self::get_latest_version($atts);
	}

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

	public function moz_download_rn_handler($atts) {
		$atts = self::mozsk_atts($atts);
		return self::get_latest_changelog_URL($atts);
	}

	private function get_product_class_for_shortcode($atts) {
		shortcode_atts(
			array('product' => NULL,
				  'platform' => NULL,
				  'channel' => NULL,
			),
			$atts
		);
		return Mozlv_Product_Factory::get_product($atts['product']);
	}

	private function mozsk_atts($atts) {
		shortcode_atts(
			array('app' => NULL,
				  'platform' => NULL,
				  'channel' => NULL,
			),
			$atts
		);
		$atts['product'] = $atts['app'];
		return $atts;
	}

	private static function getInstance() {
		if(self::$instance == NULL) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {}

}
