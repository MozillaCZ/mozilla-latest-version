<?php

/**
 * Mozlv_Product_Factory is a static class to get the product class according to the shortcode attribute.
 */
class Mozlv_Product_Factory {

	private static $products = array();

	/**
	 * Returns the product class according to the shortcode attribute.
	 * 
	 * @param string $product shortcode attribute
	 * @return Mozlv_Product_Class
	 */
	public static function get_product( $product ) {
		switch ( $product ) {
			case 'firefox':
				$product = 'firefox';
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Firefox_Desktop();
				}
				return self::$products[ $product ];
				break;
			case 'firefox-android':
			case 'android':
			case 'mobile':
			case 'fenix':
			case 'fennec':
				$product = 'firefox-android';
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Firefox_Android();
				}
				return self::$products[ $product ];
				break;
			case 'firefox-ios':
			case 'ios':
				$product = 'firefox-ios';
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Firefox_iOS();
				}
				return self::$products[ $product ];
				break;
			case 'focus-android':
				$product = 'focus-android';
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Focus_Android();
				}
				return self::$products[ $product ];
				break;
			case 'focus-ios':
				$product = 'focus-ios';
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Focus_iOS();
				}
				return self::$products[ $product ];
				break;
			case 'thunderbird':
				$product = 'thunderbird';
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Thunderbird();
				}
				return self::$products[ $product ];
				break;
			case 'seamonkey':
				$product = 'seamonkey';
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_SeaMonkey();
				}
				return self::$products[ $product ];
				break;
			default:
				return NULL;
		}
	}

}
