<?php

class Mozlv_Shortcode {

	private static $instance = NULL;

	public function get_latest_version($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		return htmlspecialchars($product_class->get_latest_version($atts['channel'], $atts['platform']));
	}

	public function get_latest_download_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		return htmlspecialchars($product_class->get_latest_download_URL($atts['channel'], $atts['platform']));
	}

	public function get_latest_langpack_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		return htmlspecialchars($product_class->get_latest_langpack_URL($atts['channel'], $atts['platform']));		
	}

	public function get_latest_changelog_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		return htmlspecialchars($product_class->get_latest_changelog_URL($atts['channel'], $atts['platform']));
	}

	public function get_latest_requirements_URL($atts) {
		$product_class = self::getInstance()->get_product_class_for_shortcode($atts);
		return htmlspecialchars($product_class->get_latest_requirements_URL($atts['channel'], $atts['platform']));
	}

	private function get_product_class_for_shortcode($atts) {
		shortcode_atts(
			array('product' => NULL,
				  'platform' => NULL,
				  'channel' => NULL,
			),
			$atts
		);
		if($atts['product'] == NULL) {
			return;
		}
		return Mozlv_Product_Factory::get_product($atts['product']);
	}

	private static function getInstance() {
		if(self::$instance == NULL) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {}

}
