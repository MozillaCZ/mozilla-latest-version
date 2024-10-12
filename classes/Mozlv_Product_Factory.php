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
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Firefox_Desktop();
				}
				return self::$products[ $product ];
				break;
			case 'android':
			case 'mobile':
			case 'fenix':
			case 'fennec':
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Firefox_Android();
				}
				return self::$products[ $product ];
				break;
			case 'ios':
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Firefox_iOS();
				}
				return self::$products[ $product ];
				break;
			case 'focus-android':
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Focus_Android();
				}
				return self::$products[ $product ];
				break;
			case 'focus-ios':
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Focus_iOS();
				}
				return self::$products[ $product ];
				break;
			case 'thunderbird':
				if ( ! isset( self::$products[ $product ] ) ) {
					self::$products[ $product ] = new Mozlv_Product_Thunderbird();
				}
				return self::$products[ $product ];
				break;
			case 'seamonkey':
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
