<?php

// Creates the Issue post type	
function silicon_prairie_issues_my_custom_post_issue_run() {
	$labels = array(
	  'name' => __('Issues', 'sppx' ),
	  'singular_name' => __( 'Issue', 'sppx' ),
	  'add_new' => __( 'Add New Issue', 'sppx' ),
	  'add_new_item' => __( 'Add New Issue', 'sppx' ),
	  'edit_item' => __( 'Edit Issue', 'sppx' ),
	  'new_item' => __( 'New Issues', 'sppx' ),
	  'view_item' => __( 'View Issue', 'sppx' ),
	  'search_items' => __( 'Search Issue Portfolio', 'sppx' ),
	  'not_found' =>  __( 'No Issues Found', 'sppx' ),
	  'not_found_in_trash' => __( 'No Issues found in Trash', 'sppx' ),
	 );

	 $args = array(
	  'labels' => $labels,
	  'has_archive' => true,
	  'public' => true,
	  'menu_icon' => 'dashicons-bank',
	  'supports' => array(
	  'title',
	  'author',
	  'editor',
	  'custom-fields',
	  'thumbnail',
	   'page-attributes'
	  ),
	  'taxonomies' => array('issue_category'),
	  'rewrite'   => array( 'slug' => 'issues' ),
	  'show_in_rest' => true
	 );

	 register_post_type( 'issue', $args );
}