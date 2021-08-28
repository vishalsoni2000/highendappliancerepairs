<?php
namespace LiquidWeb\AffiliateWP\CLI;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * WP-CLI sub-commands for integrating with AffiliateWP.
 *
 * @since 1.0
 *
 */
class Sub_Commands {

	/**
	 * Activate the AffiliateWP License
	 *
	 * ## OPTIONS
	 *
	 * <license>
	 * : License to activate
	 *
	 * ## EXAMPLES
	 *
 	 * $ wp lwsupport affiliatewp activate 366c6adcaf7dd1997c6f0268ad9d22f3
 	 * Success: Activated AffiliateWP License.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param  array 	 $args  Top-level arguments.
	 */
	public function activate( $args ) {
		list( $license_key ) = $args;
	
		// data needed to activate the license with AffiliateWP
		$api_params = [
			'edd_action' => 'activate_license',
			'license'    => $license_key,
			'item_name'  => 'AffiliateWP',
			'url'        => home_url()
		];
	
		// timeout and sslverify settings are set to match those in the AffiliateWP Plugin
		$response = wp_remote_post( 'https://affiliatewp.com', [
			'timeout'   => 35,
			'sslverify' => false,
			'body'      => $api_params
		]);
	
		if ( is_wp_error( $response ) ) {
			\WP_CLI::error( sprintf( __('License could not be activated - Error: %s', 'liquid-web-mwx'), $response->get_error_message() ) );
			exit;
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// Set WooCommerce as an integration by default to avoid a notification for the customer.
		$all_options = array_merge( 
			get_option( 'affwp_settings', [] ),
			[
				'license_status' => $license_data,
				'license_key'    => $license_key,
				'integrations'   => [
					'woocommerce' => 'WooCommerce',
				],
			]
		);
		
		$updated = update_option( 'affwp_settings', $all_options );
	
		// Only set the transient if we have something to set.
		if (! empty( $license_data->license ) ) {
			set_transient( 'affwp_license_check', $license_data->license, DAY_IN_SECONDS );
		}
	
		if ( 'valid' !== $license_data->license || empty( $license_data->success ) ) {
			\WP_CLI::error( __( 'License could not be activated. Invalid or empty response from AffiliateWP.', 'liquid-web-mwx' ) );
		} else {
			\WP_CLI::success( __( 'Activated AffiliateWP License.', 'liquid-web-mwx' ) );
		}
	}

	/**
	 * Deactivate the AffiliateWP License
	 * 
	 * ## EXAMPLES
	 * 
	 * $ wp lwsupport affiliatewp deactivate
	 * Success: Deactivated AffiliateWP License.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param  array 	 $args  Top-level arguments.
	 */
	public function deactivate( $args ) {
		$affwp_settings = get_option( 'affwp_settings', [] );

		if (empty($affwp_settings['license_key'])) {
			\WP_CLI::warning( __('AffiliateWP License is not configured.', 'liquid-web-mwx') );
			exit;
		}

		// data to send in our API request
		$api_params = [
			'edd_action' => 'deactivate_license',
			'license'    => $affwp_settings['license_key'],
			'item_name'  => 'AffiliateWP',
			'url'        => home_url()
		];

		$response = wp_remote_post( 'https://affiliatewp.com', [
			'timeout'   => 35, 
			'sslverify' => false, 
			'body'      => $api_params
		]);

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) {
			\WP_CLI::error( sprintf( __('License could not be deactivated - Error: %s', 'liquid-web-mwx'), $response->get_error_message() ) );
			exit;
		}
		
		// Set the license to inactive
		$updated = update_option( 'affwp_settings', array_merge( $affwp_settings, [ 'license_status' => 0 ] ) );
	
		\WP_CLI::success( __( 'Deactivated AffiliateWP License.', 'liquid-web-mwx' ) );
	}
}
\WP_CLI::add_command( 'lwsupport affiliatewp', 'LiquidWeb\AffiliateWP\CLI\Sub_Commands' );
