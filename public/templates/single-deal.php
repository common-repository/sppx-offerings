<?php

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">
			<?php the_title( '<h1 class="sppx-title">', '</h1>' ); ?>	
					
			<?php 
				//Set variables, including default variables
				$last_updated = get_post_meta( get_the_ID(), 'time_last_updated', true );
				$options = get_option( 'issue_plugin_options' );
				$maps_api_key = $options['api_key'];
				$response_message = get_post_meta( get_the_ID(), 'response_message', true );
				$map_insert = "";
				$last_updated_converted = strtotime( $last_updated );
				$curtime = time();
				$pdf_icon_url = plugin_dir_url( __FILE__ ) . 'images/application-pdf.png';
				$button_color = strval(get_post_meta( get_the_ID(), 'button_color', true ) );
				require_once __DIR__ . '/../../includes/update-if-needed.php';
				$uuid = "";
				$revision = "";
				$id = "";
				$name = "";
				$visibility = "";
				$portal = "";
				$website = "";
				$edgar = "";
				$forum = "";
				$thumb = "";
				$video = "";
				$raise_type = "";
				$raise_rule = "";
				$raise_minimum = "";
				$raise_minimum= "";
				$raise_maximum = "";
				$raise_maximum= "";
				$raise_target = "";
				$raise_target = "";
				$raise_raised = "";
				$raise_raised = "";
				$raise_invest = "";
				$raise_invest = "";
				$raise_lotsize = "";
				$raise_lotsize = "";
				$raise_request = "";
				$raise_request = "";
				$raise_perks = "";
				$raise_accredited = "";
				$raise_reviewed = "";
				$raise_status = "";
				$dates_start = "";
				$dates_start = "";
				$dates_end = "";
				$dates_end = "";
				$dates_target = "";
				$dates_target = "";
				$investors_count = "0";
				$investors_label = "Investors";
				$entity_address_street = "";
				$entity_address_city = "";
				$entity_address_state = "";
				$entity_address_zip = "";
				$entity_address_country = "";
				$documents = "";
				$documents_presentation = "";
				$documents_presentation_title = "";
				$documents_plan = "";
				$documents_plan_title = "";
				$documents_subscription = "";
				$documents_subscription_title = "";
				$documents_supplements = "";
				$documents_ppm = "";
				$supplements = "";
				$caveat_copyright = "";
				$caveat_warning = "";
				$copyright = "";
				$warning = "";
				$deal_teaser = "";
				$deal_details = "";
				$status = "";
				$warning = "";
				$presentation = "";
				$subscription = "";
				$video_markup = "";
				$docs_markup = "";
				$financial_docs_markup = "";
				$url_list = "";


				//Check if an update is needed
				if(($curtime - $last_updated_converted) > 3600) {  
					$post_id = get_the_ID();
					silicon_prairie_issues_update_if_needed_single($post_id);
				}

				$deal_uri_decoded = get_post_meta( get_the_ID(), 'deal_uri_decoded', true);

				if( $deal_uri_decoded ) {
					$deal_progress_bar = get_post_meta( get_the_ID(), 'deal_progress_bar', true);
					if( isset( $deal_uri_decoded['issue']['uuid'] ) ){
						$uuid = $deal_uri_decoded['issue']['uuid'];
					}
					if( isset( $deal_uri_decoded['issue']['revision'] ) ){
						$revision = $deal_uri_decoded['issue']['revision'];
					}
					if( isset( $deal_uri_decoded['issue']['id'] ) ){
						$id = $deal_uri_decoded['issue']['id'];
					}
					if( isset( $deal_uri_decoded['issue']['name'] ) ){
						$name = $deal_uri_decoded['issue']['name'];
					}
					if( isset( $deal_uri_decoded['issue']['visibility'] ) ){
						$visibility = $deal_uri_decoded['issue']['visibility'];
					}
					if( isset( $deal_uri_decoded['issue']['links']['portal'] ) ){
						$portal = $deal_uri_decoded['issue']['links']['portal'];
					}
					if( isset( $deal_uri_decoded['issue']['links']['website'] ) ){
						$website = $deal_uri_decoded['issue']['links']['website'];
					}
					if( isset( $deal_uri_decoded['issue']['links']['edgar'] ) ){
						$edgar = $deal_uri_decoded['issue']['links']['edgar'];
					}
					if( isset( $deal_uri_decoded['issue']['links']['forum'] ) ){
						$forum = $deal_uri_decoded['issue']['links']['forum'];
					}
					if( isset( $deal_uri_decoded['issue']['media']['thumb'] ) ){
						$thumb = $deal_uri_decoded['issue']['media']['thumb'];
					}
					if( isset( $deal_uri_decoded['issue']['media']['video'] ) ){
						$video = $deal_uri_decoded['issue']['media']['video'];
					}
					if( isset( $deal_uri_decoded['issue']['media']['video']['url'] ) ){
						$video = $deal_uri_decoded['issue']['media']['video']['url'];
					}
					if( isset( $deal_uri_decoded['issue']['raise']['type'] ) ){
						$raise_type = $deal_uri_decoded['issue']['raise']['type'];
					}
					if( isset( $deal_uri_decoded['issue']['raise']['rule'] ) ){
						$raise_rule = $deal_uri_decoded['issue']['raise']['rule'];
					}
					if( isset( $deal_uri_decoded['issue']['raise']['minimum'] ) ){
						$raise_minimum = $deal_uri_decoded['issue']['raise']['minimum'];
						$raise_minimum= '$' .number_format( $raise_minimum,0,'.',',' );
					}
					if( isset( $deal_uri_decoded['issue']['raise']['maximum'] ) ){	
						$raise_maximum = $deal_uri_decoded['issue']['raise']['maximum'];
						$raise_maximum= '$' .number_format( $raise_maximum,0,'.',',' );
					}
					if( isset( $deal_uri_decoded['issue']['raise']['target'] ) ){
						$raise_target = $deal_uri_decoded['issue']['raise']['target'];
						$raise_target = '$' .number_format( $raise_target,0,'.',',' );
					}
					if( isset( $deal_uri_decoded['issue']['raise']['raised'] ) ){
						$raise_raised = $deal_uri_decoded['issue']['raise']['raised'];
						$raise_raised = '$' .number_format( $raise_raised,0,'.',',' );
					}
					if( isset( $deal_uri_decoded['issue']['raise']['invest'] ) ){
						$raise_invest = $deal_uri_decoded['issue']['raise']['invest'];
						$raise_invest = '$' .number_format( $raise_invest,0,'.',',' );
					}
					if( isset( $deal_uri_decoded['issue']['raise']['lotsize'] ) ){
						$raise_lotsize = $deal_uri_decoded['issue']['raise']['lotsize'];
						$raise_lotsize = '$' .number_format($raise_lotsize,0,'.',',');
					}
					if( isset( $deal_uri_decoded['issue']['raise']['request'] ) ){
						$raise_request = $deal_uri_decoded['issue']['raise']['request'];
						$raise_request = '$' .number_format( $raise_request,0,'.',',' );
					}
					if( isset( $deal_uri_decoded['issue']['raise']['perks'] ) ){
						$raise_perks = $deal_uri_decoded['issue']['raise']['perks'];
					}
					if( isset( $deal_uri_decoded['issue']['raise']['accredited'] ) ){
						$raise_accredited = $deal_uri_decoded['issue']['raise']['accredited'];
					}
					if( isset( $deal_uri_decoded['issue']['raise']['reviewed'] ) ){
						$raise_reviewed = $deal_uri_decoded['issue']['raise']['reviewed'];
					}
					if( isset( $deal_uri_decoded['issue']['raise']['status'] ) ){
						$raise_status = $deal_uri_decoded['issue']['raise']['status'];
					}
					if( isset( $deal_uri_decoded['issue']['dates']['start'] ) ){
						$dates_start = strtotime( $deal_uri_decoded['issue']['dates']['start'] );
						$dates_start = date( 'l, F j, Y', $dates_start );
					}
					if( isset( $deal_uri_decoded['issue']['dates']['end'] ) ){
						$dates_end = strtotime( $deal_uri_decoded['issue']['dates']['end'] );
						$dates_end = date( 'l, F j, Y', $dates_end );
					}
					if( isset( $deal_uri_decoded['issue']['dates']['target'] ) ){
						$dates_target = strtotime( $deal_uri_decoded['issue']['dates']['target'] );
						$dates_target = date( 'l, F j, Y', $dates_target );
					}
					if( isset( $deal_uri_decoded['issue']['investors']['count'] ) ){
						$investors_count = $deal_uri_decoded['issue']['investors']['count'];
					}
					if( isset( $deal_uri_decoded['issue']['investors']['label'] ) ){
						$investors_label = $deal_uri_decoded['issue']['investors']['label'];
					}
					if( isset( $deal_uri_decoded['issue']['entity']['address']['street'] ) ){
						$entity_address_street = $deal_uri_decoded['issue']['entity']['address']['street'];
					}
					if( isset( $deal_uri_decoded['issue']['entity']['address']['city'] ) ){
						$entity_address_city = $deal_uri_decoded['issue']['entity']['address']['city'];
					}
					if( isset( $deal_uri_decoded['issue']['entity']['address']['state'] ) ){
						$entity_address_state = $deal_uri_decoded['issue']['entity']['address']['state'];
					}
					if( isset( $deal_uri_decoded['issue']['entity']['address']['zip'] ) ){
						$entity_address_zip = $deal_uri_decoded['issue']['entity']['address']['zip'];
					}
					if( isset( $deal_uri_decoded['issue']['entity']['address']['country'] ) ){
						$entity_address_country = $deal_uri_decoded['issue']['entity']['address']['country'];
					}
					// Generate docs markup, if docs exist
					if( isset( $deal_uri_decoded['issue']['documents'] ) ){
						foreach ($deal_uri_decoded['issue']['documents'] as $key => $value) {
							$heading = ucfirst($key);

							if($heading === 'Financials') {
								$docs_markup .= '';
							}

							else {

								$counted = count($value);

								if($counted == 1) {
									$position = "inline";
									$url_string = $value['url'];
									$title = urldecode( substr( strrchr( rtrim( $url_string, '/' ), '/' ), 1 ) );
									$url_single = '<div class="field-item even"><img class="file-icon" title="application/pdf" src="' . $pdf_icon_url . '" alt="" /> <a href="'. $url_string .'" target="_blank" type="application/pdf; length=6692120">' . $title . '</a></div><br>';

									$docs_markup .= '<div class="field field-name-field-issue-file-amendments field-type-file field-label-' . $position . '" clearfix">
												<div class="field-label">' . $heading .':&nbsp;</div>
													<div class="field-items">' . $url_single . '</div>
											</div>';
								}else {
									$position = "above";

									foreach ( $value as $type => $urls) {

										$title = urldecode( substr( strrchr( rtrim( $urls['url'], '/' ), '/' ), 1 ) );
										$url_list .= '<div class="field-item even"><img class="file-icon" title="application/pdf" src="' . $pdf_icon_url . '" alt="" /> <a href="'. $urls['url'] .'" target="_blank" type="application/pdf; length=6692120">' . $title . '</a></div><br>';
									}

								$docs_markup .= '<div class="field field-name-field-issue-file-amendments field-type-file field-label-' . $position . '" clearfix">
													<div class="field-label">' . $heading .':&nbsp;</div>
													<div class="field-items">' . $url_list . '</div>
												</div>';
									
								}
							}
							
						}

					}

					if( isset( $deal_uri_decoded['issue']['documents']['financials'] ) ){

						foreach ($deal_uri_decoded['issue']['documents']['financials'] as $key => $value) {
							$heading = ucfirst($key);

							$counted = count($value);

							if($counted == 1) {
								$position = "inline";
								$url_string = $value['url'];
								$title = urldecode( substr( strrchr( rtrim( $url_string, '/' ), '/' ), 1 ) );
								$url_single = '<div class="field-item even"><img class="file-icon" title="application/pdf" src="' . $pdf_icon_url . '" alt="" /> <a href="'. $url_string .'" target="_blank" type="application/pdf; length=6692120">' . $title . '</a></div><br>';

								$financial_docs_markup .= '<div class="field field-name-field-issue-file-amendments field-type-file field-label-' . $position . '" clearfix">
											<div class="field-label">' . $heading .':&nbsp;</div>
												<div class="field-items">' . $url_single . '</div>
										</div>';
							}else {
								$position = "above";

								foreach ( $value as $type => $urls) {

									$title = urldecode( substr( strrchr( rtrim( $urls['url'], '/' ), '/' ), 1 ) );
									$url_list .= '<div class="field-item even"><img class="file-icon" title="application/pdf" src="' . $pdf_icon_url . '" alt="" /> <a href="'. $urls['url'] .'" target="_blank" type="application/pdf; length=6692120">' . $title . '</a></div><br>';
								}

							$financial_docs_markup .= '<div class="field field-name-field-issue-file-amendments field-type-file field-label-' . $position . '" clearfix">
												<div class="field-label">' . $heading .':&nbsp;</div>
												<div class="field-items">' . $url_list . '</div>
											</div>';
								
							}
							
						}
					}

					if( isset( $deal_uri_decoded['issue']['documents']['presentation']['url'] ) ){
						$documents_presentation = $deal_uri_decoded['issue']['documents']['presentation']['url'];
						$documents_presentation_title = urldecode( substr( strrchr( rtrim( $documents_presentation, '/' ), '/' ), 1 ) );
					}
					if( isset( $deal_uri_decoded['issue']['documents']['plan']['url'] ) ){
						$documents_plan = $deal_uri_decoded['issue']['documents']['plan']['url'];
						$documents_plan_title = urldecode( substr( strrchr( rtrim( $documents_plan, '/' ), '/' ), 1 ) );
					}
					if( isset( $deal_uri_decoded['issue']['documents']['ppm']['url'] ) ){
						$documents_ppm = $deal_uri_decoded['issue']['documents']['ppm']['url'];
						$documents_ppm_title = urldecode( substr( strrchr( rtrim( $documents_ppm, '/' ), '/' ), 1 ) );
					}
					if( isset( $deal_uri_decoded['issue']['documents']['subscription']['url'] ) ){
						$documents_subscription = $deal_uri_decoded['issue']['documents']['subscription']['url'];
						$documents_subscription_title = urldecode( substr( strrchr( rtrim( $documents_subscription, '/' ), '/' ), 1 ) );
					}
					if( isset( $deal_uri_decoded['issue']['documents']['supplements'] ) ){
						$documents_supplements = $deal_uri_decoded['issue']['documents']['supplements'];
					}

					// Only generate markup for map if Google Maps API key is set in the app's settings page.
					if($maps_api_key !== '' && $entity_address_city !== ''){
						$map_insert = '<div>
							<iframe
							  width="600"
							  height="450"
							  style="border:0"
							  loading="lazy"
							  allowfullscreen
							  src="https://www.google.com/maps/embed/v1/place?key=' . $maps_api_key .'&q=' . $entity_address_street . ',' . $entity_address_city .'+ ' . $entity_address_state .'">
							</iframe>
						</div>';
					}

					// Only generate markup for youtube if it exists.
					if (strpos( $video, 'https://youtu.be/' ) !== false ) {
						$video_id = str_replace( "https://youtu.be/", "", $video );
						$video_markup = '<div class="field field-name-field-issue-video field-type-video-embed-field field-label-hidden"><div class="field-items"><div class="field-item even"><div class="embedded-video"><div class="player"><iframe src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen"></iframe></div></div></div></div></div>';
					}
		   
		   			// Only generate markup for vimeo if it exists.
					if (strpos( $video, 'https://vimeo.com/') !== false ) {
						$video_id = str_replace( "https://vimeo.com/", "", $video );
						$video_markup = '<div class="field field-name-field-issue-video field-type-video-embed-field field-label-hidden"><div class="embedded-video><div class="player"><iframe width="640" height="360" src="https://player.vimeo.com/video/' . $video_id . '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe><div></div></div></div></div>';
					}


					// Only generate markup for edgar if it exists.
					if(!empty( $edgar ) ) {
							$title = urldecode( substr( strrchr( rtrim( $edgar, '/' ), '/' ), 1 ) );
							$edgar = '<div class="field-item even"><a href="'. $edgar .'" target="_blank">Company Search Results</a></div><br>';
							$edgar = '<div class="field field-name-field-issue-link-to-edgar field-type-link-field field-label-above">
											<div class="field-label">Link to EDGAR:&nbsp;</div>
											<div class="field-items">' . $edgar . '</div>
									  </div>';
					}

					if($status!==('Funded')) {
						$invest_link = 'href="' . $portal . '"';
					}else{
						$invest_link = '';
					}

					if( isset( $deal_uri_decoded['issue']['caveat']['copyright'] ) ){
						$caveat_copyright = base64_decode($deal_uri_decoded['issue']['caveat']['copyright']);
						$copyright = '<div class="sppx-plugin-copyright">' . $caveat_copyright . '</div>';
					}
					if( isset( $deal_uri_decoded['issue']['caveat']['warning'] ) ){
						$caveat_warning = base64_decode($deal_uri_decoded['issue']['caveat']['warning']);
						$warning = '<div class="sppx-plugin-warning">' . $caveat_warning . '</div>';
					}
					if( isset ($deal_uri_decoded['issue']['page']['teaser'] ) ){
						$deal_teaser = base64_decode($deal_uri_decoded['issue']['page']['teaser']);
					}
					if( isset( $deal_uri_decoded['issue']['page']['details'] ) ){
						$deal_details = base64_decode( $deal_uri_decoded['issue']['page']['details'] );
					}

				}

				if( $response_message == 'OK' ) {
					echo '<div typeof="sioc:Item foaf:Document" class="ds-2col-stacked node node-issue view-mode-full clearfix">
					<div class="group-left">
					<div class="field field-name-field-issue-raised-to-date field-type-number-integer field-label-above">
					<div class="field-label">Raised to Date:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_raised . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-investor-label field-type-text field-label-hidden">
					<div class="field-items">
					<div class="field-item even">' . $investors_count .' ' . $investors_label . '</div>
					</div>
					</div>
					<div class="collapsible group-issue-buttons field-group-div speed-fast effect-none fieldgroup-effects-processed">
					<div class="field-group-format-wrapper" style="display: block;">
					<div class="field field-name-stacked-progress-bar field-type-ds field-label-hidden">
					<div class="field-items">
					<div class="field-item even">' . $deal_progress_bar . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-invest-button field-type-text field-label-hidden">
					<div class="field-items">
					<div class="field-item even">
					<a class="sppx-button sppx-invest-closed" ' . $invest_link . ' style="background-color:' . $button_color . '" target="_blank">'. $raise_status . '</a></div>
					</div>
					</div>
					<div class="field field-name-field-issue-membership-button field-type-text-long field-label-hidden">
					<div class="field-items">
					<div class="field-item even">
					<a class="sppx-button" href="' . $invest_link . '" style="background-color:' . $button_color . '">I am Accredited</a>
					</div>
					</div>
					</div>
					</div>
					</div>
					<div class="field field-name-field-issue-id field-type-text field-label-inline clearfix">
					<div class="field-label">ID:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $id . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-exemption field-type-list-text field-label-inline clearfix">
					<div class="field-label">Exemption:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_rule . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-type field-type-taxonomy-term-reference field-label-inline clearfix">
					<div class="field-label">Issue Type:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_type . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-accredited-only field-type-list-boolean field-label-inline clearfix">
					<div class="field-label">Accredited Only:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_accredited . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-fin-review field-type-list-boolean field-label-inline clearfix">
					<div class="field-label">Reviewed Financials:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_reviewed . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-invest-min field-type-list-integer field-label-inline clearfix">
					<div class="field-label">Minimum Investment:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_invest . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-invest-suggest field-type-number-integer field-label-inline clearfix">
					<div class="field-label">Suggested Investment:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_request . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-invest-unit field-type-number-integer field-label-inline clearfix">
					<div class="field-label">Additional Investments:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_lotsize . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-amount-target field-type-number-integer field-label-inline clearfix">
					<div class="field-label">Target Goal:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_target . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-amount-min field-type-number-integer field-label-inline clearfix">
					<div class="field-label">Minimum Goal:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_minimum . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-amount-max field-type-number-integer field-label-inline clearfix">
					<div class="field-label">Maximum Goal:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $raise_maximum . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-date-start field-type-datetime field-label-inline clearfix">
					<div class="field-label">Raise Start Date:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $dates_start . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-date-end field-type-datetime field-label-inline clearfix">
					<div class="field-label">Raise End Date:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $dates_end . '</div>
					</div>
					</div>
					<div class="field field-name-field-issue-date-target field-type-datetime field-label-inline clearfix">
					<div class="field-label">Raise Target Date:&nbsp;</div>
					<div class="field-items">
					<div class="field-item even">' . $dates_target . '</div>
					</div>
					</div>
					' . $docs_markup . '' . '' . $financial_docs_markup . '' . $edgar . '
					<div class="field field-name-field-issue-discuss-button field-type-text-long field-label-hidden">
					<div class="field-items">
					<div class="field-item even">
					<p><a class="sppx-button" href="' . $forum . '" style="margin-bottom:20px;background-color:' . $button_color . '" target="_blank">Discussion Board</a></p>
					</div>
					</div>
					</div>
					<div class="field field-name-field-issue-geocode field-type-geofield field-label-hidden">
					<div class="field-items">
					<div class="field-item even">'. $map_insert . '</div>
					</div>
					</div>
					</div>
					<div class="group-right">
					' . $video_markup . '
					<div class="field field-name-body field-type-text-with-summary field-label-hidden">
					<div class="field-items">
					<div class="field-item even" property="content:encoded">' . $deal_details . '
					</div>
					</div>
					</div>
					</div>
				    ' .$copyright . '' . $warning . '
					</div>';
				}
				else {
					echo '<div style="margin:0 auto;text-align:center;padding-bottom:40px;">
					<h3>Network Error</h3>
					<p>Sorry, there was an error fetching data for this issue. Please contact a site administrator or try again later.</p>
					</div>';
				}	
			?>

		</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
	</footer><!-- .entry-footer -->

	</article><!-- #post-<?php the_ID(); ?> -->

<?php 

endwhile; // End of the loop.

get_footer();