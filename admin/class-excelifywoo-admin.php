<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://urasaapi.com
 * @since      1.0.0
 *
 * @package    Excelifywoo
 * @subpackage Excelifywoo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Excelifywoo
 * @subpackage Excelifywoo/admin
 * @author     asad <asadurrehm890@gmail.com>
 */
class Excelifywoo_Admin {

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
		 * defined in Excelifywoo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Excelifywoo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/excelifywoo-admin.css', array(), $this->version, 'all' );

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
		 * defined in Excelifywoo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Excelifywoo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/excelifywoo-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script($this->plugin_name, 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
	}
	
	
	public function excelifywoo_admin_menu(){
		add_menu_page(
			'excelifywoo Import', // Page title
			'excelifywoo Import', // Menu title
			'manage_options', // Capability required to access the menu
			'excelifywoo-menu', // Menu slug (should be unique)
			array($this,'excelifywoo_menu_callback'), // Callback function to display the menu page
			'dashicons-admin-generic', // Icon URL or Dashicons class
			25 // Position of the menu item in the admin menu
		);


		/*add_submenu_page(
        'excelifywoo-menu',
        'excelifywoo export',
        'excelifywoo export',
        'manage_options',
        'excelifywoo_export',
        array($this, 'excelifywoo_export_callback')
    );*/
	}
	
	public function excelifywoo_menu_callback(){
		require_once dirname(__FILE__).'/partials/excelifywoo-admin-display.php';
	}

	public function excelifywoo_export_callback(){
		require_once dirname(__FILE__).'/partials/excelifywoo-admin-display-export.php';
		excelifywoo_admin_export::excelifywoo_export_display();
	}

	public function excelifywoo_export_action(){
		require_once dirname(__FILE__).'/partials/excelifywoo-admin-display-export.php';
		excelifywoo_admin_export::excelifywoo_export_csv();
	}

}
