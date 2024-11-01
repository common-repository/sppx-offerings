<?php

/**
 *
 * @link       http://www.bitsourceky.com
 * @since      1.0.0
 *
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/includes
 */

/**
 * 
 *
 * This class defines all code necessary for the plugin's custom metabox fields.
 *
 * @since      1.0.0
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/includes
 * @author     Bit Source <developers@bitsourceky.com>
 */
class Silicon_prairie_issues_Issue_Meta_Box {

	public function init_metabox() {
		add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
		add_action( 'pre_post_update',       array( $this, 'presave_metabox' ), 10, 2 );
		add_action( 'save_post',             array( $this, 'save_metabox' ), 9, 2 );
	}

	public function add_metabox() {

		add_meta_box(
			'issue-box',
			__( 'Issue', 'text_domain' ),
			array( $this, 'render_metabox' ),
			'issue',
			'advanced',
			'default'
		);

	}

	public function render_metabox( $post ) {

		// Retrieve an existing value from the database.
		$custom_deal_uri = get_post_meta( $post->ID, 'custom_deal_uri', true );
		$time_last_updated = get_post_meta( $post->ID, 'time_last_updated', true );
		$progress_bars = get_post_meta( $post->ID, 'deal_progress_bar', true );
		$button_color = get_post_meta( $post->ID, 'button_color', true );
		$response_message = get_post_meta( $post->ID, 'response_message', true );
		$error = get_post_meta( $post->ID, 'post_errors', true );

		// Set default values.
		if( empty( $custom_deal_uri ) ) $custom_deal_uri = '';
		if( empty( $time_last_updated ) ) $time_last_updated = time();
		if( empty($progress_bars ) ) $progress_bars = '';
		if( empty($button_color ) ) $button_color = '#E0A300';
		if( empty($error ) ) $error = 'no error';
		if( empty($response_message ) ) $response_message = 'no response yet';


		// Form fields.
		echo '<table class="form-table">';
		echo '		<th><label for="custom_deal_uri" class="custom_deal_uri_label">' . __( 'URI', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="custom_deal_uri" name="custom_deal_uri" class="custom_deal_uri_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr( $custom_deal_uri ) . '">';
		echo '			<p class="description">' . __( 'Input the full URI related to this deal.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';
		echo '	<tr>';
		echo '		<th><label for="button_color" class="button_color_label">' . __( 'Button Color', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="button_color" name="button_color" class="button_color_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr( $button_color ) . '">';
		echo '			<p class="description">' . __( 'Add a hexedcimal color code for the issue buttons. Do not add a trailing semicolon.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';
		echo '	<tr>';
		echo '		<th><label for="time_last_updated" class="time_last_updated_label">' . __( 'Time Last Updated', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<p class="time">' . date( 'Y-m-d H:i:s', $time_last_updated ). '</p>';
		echo '		</td>';
		echo '	</tr>';
		echo '</table>';
		echo '<p>© 2021 - Crowdfunding portal hosted by Silicon Prairie Capital Partners, an SEC/FINRA reporting broker dealer.</p><p>Investments appearing on this portal involve significant risks including, illiquidity, no guarantee of returns, and possible loss of principal invested.</p><p>For more information, see our investor education materials. Not FDIC insured.</p><p>Crowdfunding portal platform licensed from Silicon Prairie Portal & Exchange, LLC</p>';



	}

	public function presave_metabox( $data, $postarr ){

		// Bail out if this is an autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		        return;
		}
		 
		// Bail out if this is not an issue item
		if ( 'issue' !== $postarr['post_type']) {
		        return;
		}

		$post_id = get_the_id();
		$response_message = 'no response yet';

		$args = array( 
			'timeout' => 10
		);

	    $custom_new_deal_uri = isset( $_POST[ 'custom_deal_uri' ] ) ? sanitize_text_field( $_POST[ 'custom_deal_uri' ] ) : '';
	    // Attempt to fetch the data from the API.
		if(! $custom_new_deal_uri )
			return;

		$deal_uri_object = wp_remote_get( $custom_new_deal_uri , $args );
		if ( is_wp_error( $deal_uri_object) ) {
			echo 'Network error! Please try again!';
		} else {
			$response_message = wp_remote_retrieve_response_message( $deal_uri_object );
		}

		if($response_message == 'OK') {
	    	update_post_meta( $post_id, 'saved_object', $deal_uri_object );
	    	update_post_meta( $post_id, 'response_message', $response_message );
		}else{
	        $error = "Network error!";
		}
	}	

	public function save_metabox( $post_id, $post ) {


		require_once __DIR__ . '/progress_bars.php';

		// Bail out if this is an autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		        return;
		}
		 
		// Bail out if this is not an issue item
		if ( 'issue' !== $post->post_type ) {
		        return;
		}

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Sanitize user input.
		$custom_new_deal_uri = isset( $_POST[ 'custom_deal_uri' ] ) ? sanitize_text_field( $_POST[ 'custom_deal_uri' ] ) : '';
		$button_color = isset( $_POST[ 'button_color' ] ) ? sanitize_text_field( $_POST[ 'button_color' ] ) : '';
		$response_message = get_post_meta( $post->ID, 'response_message', true );
		$deal_uri_object = get_post_meta( $post->ID, 'saved_object', true );

		// Provide a default button color.
		if(!isset( $button_color ) ) {
			$button_color = '#E0A300';
		}


		// If a connection is made begin setting values.
		if( $response_message !== 'no response yet' && $response_message == 'OK' ){
			$deal_uri_json = wp_remote_retrieve_body( $deal_uri_object );
			$deal_uri_decoded = json_decode( $deal_uri_json , true );

			$minimum = intval( $deal_uri_decoded['issue']['raise']['minimum'] );
			$target = intval( $deal_uri_decoded['issue']['raise']['target'] );
			$raised = intval( $deal_uri_decoded['issue']['raise']['raised'] );

			// Call out to a helper function to calculate progress bars.
			$progress_bar_output = silicon_prairie_issues_progress_bars( $minimum, $target, $raised );

			// Update the meta fields in the database.
			// update_post_meta( $post_id, 'saved_object', $deal_uri_object );
			// update_post_meta( $post_id, 'response_message', $response_message );
			update_post_meta( $post_id, 'custom_deal_uri', $custom_new_deal_uri );
			update_post_meta( $post_id, 'deal_uri_decoded', $deal_uri_decoded );
			update_post_meta( $post_id, 'button_color', $button_color );
		    update_post_meta( $post_id, 'deal_progress_bar',  $progress_bar_output );
			update_post_meta( $post_id, 'time_last_updated', time() );
			update_post_meta( $post_id, 'post_errors', 'Still no error' );
		}else{
			update_post_meta( $post_id, 'post_errors', 'Sorry there has been an error!' );
		}
	}

	private function write_log( $log ) {
    	if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
	}

}

