<?php

class Mozlv_Product_Factory {

	private static $products = array();

	public static function get_product($product) {
		switch($product) {
			case 'firefox':
				if(!isset(self::$products[$product])) {
					self::$products[$product] = new Mozlv_Product_Firefox();
				}
				return self::$products[$product];
				break;
			case 'mobile':
				if(!isset(self::$products[$product])) {
					self::$products[$product] = new Mozlv_Product_Mobile();
				}
				return self::$products[$product];
				break;
			case 'thunderbird':
				if(!isset(self::$products[$product])) {
					self::$products[$product] = new Mozlv_Product_Thunderbird();
				}
				return self::$products[$product];
				break;
			case 'seamonkey':
				if(!isset(self::$products[$product])) {
					self::$products[$product] = new Mozlv_Product_SeaMonkey();
				}
				return self::$products[$product];
				break;
			default:
				return NULL;
		}
	}

}
