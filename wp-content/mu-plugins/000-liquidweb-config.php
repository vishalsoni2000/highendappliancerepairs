<?php
/**
 * Plugin Name: Liquid Web Managed WordPress Configuration
 * Plugin URI:  https://www.liquidweb.com
 * Description: Configuration to support the Liquid Web Managed WordPress and WooCommerce platforms.
 * Author:      Liquid Web
 * Author URI:  https://www.liquidweb.com
 * Text Domain: liquid-web-mwp
 * Domain Path: /languages
 * Version:     1.0.0
 *
 * @package LiquidWeb\MWP\Config
 * @author  Liquid Web
 */

/** LW specific constants **/
define( 'LWMWP_SITE', true );
define( 'LWMWP_PLAN_NAME', 'Agency: Up to 50 Sites' );
defined( 'LWMWP_SITE_ENDPOINT' ) || define('LWMWP_SITE_ENDPOINT', 'https://app.agvnt68s-liquidwebsites.com/api/sites/32/');
defined( 'LWMWP_API_TOKEN' )     || define('LWMWP_API_TOKEN',     'b6134073-4eca-42d5-b656-22c01bc5847c');

/** Fail2Ban **/
defined('WP_FAIL2BAN_BLOCK_USER_ENUMERATION') || define('WP_FAIL2BAN_BLOCK_USER_ENUMERATION', true);

