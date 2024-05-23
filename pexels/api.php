<?php

/**
 * API
 */
namespace PexelsWp;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * API Class
 */
class Api {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Verify Request
	 * @version 1.0.0
	 * @return boolean
	 */
	public function verify_request( $request ) {
		return true;
	}

	/**
	 * Prepare Request
	 * @version 1.0.0
	 */
	public function prepare_request( $request ) {

		$verify = $this->verify_request( $request );

		if ( ! $verify ) {
			return new \WP_Error( 400, esc_html__( 'Invalid API Key', 'pexels' ), array( 'status' => 400 ) );
		}

		/**
		 * Get parameters from API Call
		 */

		$parameters_data = $request->get_params();
		$parameters      = isset( $parameters_data['data'] ) ? $parameters_data['data'] : $parameters_data;
		$search          = isset( $parameters['search'] ) ? sanitize_text_field( $parameters['search'] ) : '';
        $api_key         = isset( $parameters['api_key'] ) ? sanitize_text_field( $parameters['api_key'] ) : '';

        if( empty( $search ) ) {
            return new \WP_Error( 400, esc_html__( 'Search query is required', 'pexels' ), array( 'status' => 400 ) );
        }

        if( empty( $api_key ) ) {
            return new \WP_Error( 400, esc_html__( 'API Key is required', 'pexels' ), array( 'status' => 400 ) );
        }

        $page = isset( $parameters['page'] ) ? absint( $parameters['page'] ) : 1;
        $per_page = isset( $parameters['per_page'] ) ? absint( $parameters['per_page'] ) : 15;
        
        /**
         * Get Images
         */
        $images = Generator::get_images( $search, $api_key, $page, $per_page );

        if ( is_wp_error( $images ) ) {
            return new \WP_Error( 400, esc_html__( 'Error fetching images', 'pexels' ), array( 'status' => 400 ) );
        }

        return rest_ensure_response( $images );
	}

	/**
	 * Register REST API routes
	 * @version 1.0.0
	 * @return void
	 */
	public function register_routes() {
		$namespace = 'pexels';
		$base      = '/v1';

		register_rest_route(
			$namespace,
			$base,
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'prepare_request' ),
				'permission_callback' => '__return_true',
			)
		);
	}
}