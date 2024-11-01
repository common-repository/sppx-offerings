<?php

//Helper function to update the Issue if needed

function silicon_prairie_issues_update_if_needed_single( $id ) {

	require_once('progress_bars.php');

	// Retrieve values from the database.
	$custom_deal_uri = get_post_meta( $id, 'custom_deal_uri', true );
	$deal_uri_decoded = get_post_meta( $id, 'deal_uri_decoded', true );

	// Contact the API to get the data.
	$new_deal_uri_object = wp_remote_get( $custom_deal_uri );
	$response_message = wp_remote_retrieve_response_message( $new_deal_uri_object );

	// Make sure the response was valid. If not record the time of the attempted update and exit so the software can try again at the next interval.
	if ( $response_message !== 'OK' ) {
		update_post_meta( $id, 'time_last_updated', time() );
		return;
	}

	// Process newly retrieved data.
	$new_deal_uri_json = wp_remote_retrieve_body( $new_deal_uri_object );
	$new_deal_uri_decoded = json_decode( $new_deal_uri_json, true );

	// Compare the new data to the old. If it is different update fields.
	if($deal_uri_decoded !== $new_deal_uri_decoded) {

		$minimum = $new_deal_uri_decoded['issue']['raise']['minimum'];
		$target = $new_deal_uri_decoded['issue']['raise']['target'];
		$raised = $new_deal_uri_decoded['issue']['raise']['raised'];

		// Call helper function to calculate progress bars.
		$progress_bar_output = silicon_prairie_issues_progress_bars( $minimum, $target, $raised );

		// Update the meta fields in the database.
		update_post_meta( $id, 'deal_uri_decoded', $new_deal_uri_decoded );
		update_post_meta( $id, 'deal_progress_bar',  $progress_bar_output );
		update_post_meta( $id, 'time_last_updated', time() );
	}else{
		update_post_meta( $id, 'time_last_updated', time() );
	}
}