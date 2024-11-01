<?php

//Functions the create the markup for multiple progress bar types displayed on the front end. These are fed information about the funding levels of each issue.
function silicon_prairie_issues_progress_bars( $minimum_raise, $stretch_raise, $raised_to_date ) {
  if ( empty( $minimum_raise ) ) {
    // Private offerings have no minimum raise.
    $output = silicon_prairie_issues_progress_bar_no_minimum( $stretch_raise, $raised_to_date );
  }
  elseif ( $raised_to_date == 0 || $raised_to_date < $minimum_raise ) {
    $output = silicon_prairie_issues_single_progress_bar( $minimum_raise, $raised_to_date );
  }
  else {
    $output = silicon_prairie_issues_double_progress_bar( $minimum_raise, $stretch_raise, $raised_to_date );
  }
  return $output;
}

/**
 *
 */
function silicon_prairie_issues_single_progress_bar( $minimum_raise, $raised_to_date ) {
  if ( $minimum_raise ) {
    $percent = min(100, floor( 100 * $raised_to_date / $minimum_raise ) );
  } else {
    // Avoid division by zero.
    $percent = 0;
  }

  // TRIPLO-353.
  if ( $percent == 0 && $raised_to_date > 0 ) {
    $percent = 1;
  }
  return silicon_prairie_issues_progress_bar( $percent );
}

function silicon_prairie_issues_progress_bar( $pct_funded ) {
  $output = '<div id="progress" class="progress">
<div class="bar">
<div class="filled" style="width:' . $pct_funded . '%">
</div>
</div>
<div class="percentage">' . $pct_funded . '%</div>
<div class="message">Funded:</div>
</div>';
  return $output;
}

/**
 *
 */
function silicon_prairie_issues_double_progress_bar( $minimum_raise, $stretch_raise, $raised_to_date ) {
  $pct_stretch = floor( 100 * $raised_to_date / $stretch_raise );
  $green = floor( 100 * $minimum_raise / $stretch_raise );
  $gold = max(0, min( 100, $pct_stretch) - $green );
  $white = 100 - $green - $gold;
  $notgreen = 100 - $green;
  $min_fmt = '$' . number_format( $minimum_raise );
  $stretch_fmt = '$' . number_format( $stretch_raise );
  $output = 
'<div class="stacked-bar-graph">
 <span style="width:' . $green . '%" class="bar-1"></span>
 <span style="width:' . $gold . '%" class="bar-2"></span>
 <span style="width:' . $white . '%" class="bar-3"></span>
</div>
<div class="stacked-bar-graph-legend">
 <span style="width:' . $green . '%" class="bar-1">Min&nbsp;goal<br>' . $min_fmt . '</span>
 <span style="width:' . $notgreen. '%" class="bar-2">Stretch goal<br>' . $stretch_fmt . '</span>
 </div>';

  return $output;
}

/**
 *
 */
function silicon_prairie_issues_progress_bar_no_minimum( $stretch_raise, $raised_to_date ) {
  $pct_stretch = floor( 100 * $raised_to_date / $stretch_raise );
  $gold = max( 0, min( 100, $pct_stretch) );
  $white = 100 - $gold;
  $stretch_fmt = '$' . number_format( $stretch_raise );
  $output = '<div class="stacked-bar-graph">
 <span style="width:' . $gold . '%" class="bar-2"></span>
 <span style="width:' . $white . '%" class="bar-3"></span>
</div>
<div class="stacked-bar-graph-legend">
 <span style="width:100%" class="bar-3">Funding goal</span>
 </div>
 <div class="stacked-bar-graph-legend">
 <span style="width:100%" class="bar-3">' . $stretch_fmt . '</span> 
</div>';
  return $output;
}