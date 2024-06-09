<?php
namespace Automattic\WooCommerce\StoreApi\Schemas\V1;

/**
 * ErrorSchema class.
 */
class ErrorSchema extends AbstractSchema {
	/**
	 * The schema item name.
	 *
	 * @var string
	 */
	protected $title = 'error';

	/**
	 * The schema item identifier.
	 *
	 * @var string
	 */
	const IDENTIFIER = 'error';

	/**
	 * Product schema properties.
	 *
	 * @return array
	 */
	public function get_properties() {
		return [
			'code'    => [
				'description' => __( 'Error code', 'woocommerce' ),
				'type'        => 'string',
				'context'     => [ 'view', 'edit' ],
				'readonly'    => true,
			],
			'message' => [
				'description' => __( 'Error message', 'woocommerce' ),
				'type'        => 'string',
				'context'     => [ 'view', 'edit' ],
				'readonly'    => true,
			],
		];
	}

	/**
	 * Convert a WP_Error into an object suitable for the response.
	 *
	 * @param \WP_Error $error Error object.
	 * @return array
	 */
	public function get_item_response( $error ) {
		$error_code = $error->get_error_code();
		return [
			'code'    => $this->prepare_html_response( $error_code ),
			'message' => $this->prepare_html_response( $error->get_error_message() ),
			'data'	  => $this->prepare_html_response( $error->get_error_data($error_code))
		];
	}

}
