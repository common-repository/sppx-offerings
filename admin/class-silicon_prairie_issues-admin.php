<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.bitsourceky.com
 * @since      1.0.0
 *
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/admin
 * @author     Bit Source <developers@bitsourceky.com>
 */
class Silicon_prairie_issues_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}


	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/silicon_prairie_issues-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/silicon_prairie_issues-admin.js', array( 'jquery' ), $this->version, false );

	}

	//Adding a settings page to store our Google Maps API Key.
	public function issue_add_settings_page() {
        add_options_page( 'Issue plugin page', 'Issue Plugin Menu', 'manage_options', $this->plugin_name, array($this, 'issue_render_plugin_settings_page' ) );
    }

    public function issue_render_plugin_settings_page() {
        ?>
        <h2>Issue Plugin Settings</h2>
        <form action="options.php" method="post">
            <?php 
            settings_fields( 'issue_plugin_options' );
            do_settings_sections( $this->plugin_name ); ?>
            <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
        </form>
        <?php
    }

    public function issue_register_settings() {
        register_setting( 'issue_plugin_options', 'issue_plugin_options' );
        add_settings_section( 'api_settings', 'API Settings', array($this, 'issue_plugin_section_text' ), $this->plugin_name );

        add_settings_field( 'issue_plugin_setting_api_key', 'Google Maps API Key', array($this, 'issue_plugin_setting_api_key' ), $this->plugin_name, 'api_settings' );
    }


    public function issue_plugin_section_text() {
        echo '<p>Enter Your Google Maps API Key</p>';
    }

    public function issue_plugin_setting_api_key() {
        $options = get_option( 'issue_plugin_options' );
        echo "<input id='issue_plugin_setting_api_key' name='issue_plugin_options[api_key]' type='text' value='" . esc_attr( $options['api_key'] ) . "' />";
    }

/**
* Creates a new custom post type issues
*
* @since 1.0.0
* @access public
* @uses register_post_type()
*/

	public static function my_custom_post_issue() {

		//Registers custom post type

		require_once __DIR__ . '/../includes/register_issue_post_type.php';

		silicon_prairie_issues_my_custom_post_issue_run();
		
	}
}
