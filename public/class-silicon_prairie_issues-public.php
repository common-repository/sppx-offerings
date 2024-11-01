<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.bitsourceky.com
 * @since      1.0.0
 *
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/public
 * @author     Bit Source <developers@bitsourceky.com>
 */
class Silicon_prairie_issues_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Silicon_prairie_issues_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Silicon_prairie_issues_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/silicon_prairie_issues-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Silicon_prairie_issues_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Silicon_prairie_issues_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/silicon_prairie_issues-public.js', array( 'jquery' ), $this->version, false );

	}

	public function silicon_prairie_issues_custom_template ($single ) {

    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'issue' ) {
        if ( file_exists( plugin_dir_path( __FILE__ ) . 'templates/single-deal.php' ) ) {
            return plugin_dir_path( __FILE__ ) . 'templates/single-deal.php';
        }
    }

    return $single;

}

}
