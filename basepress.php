<?php
/**
 * Plugin Name:  Base.Press
 * Plugin URI:   https://base.press
 * Description:  Core and must-have features management
 * Version:      0.1.0
 * Author:       Ihor Vorotnov
 * Author URI:   https://ihorvorotnov.com
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Main plugin class.
 *
 * @since 0.1.0
 */
class Basepress {

	/**
	 * @var array Plugin options stored in database.
	 * @access public
	 * @since 0.1.0
	 */
	public $settings;

	/**
	 * Class constructor.
	 * Initializes options and functionality.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {

		$this->add_setting( 'version', '0.1.0' );
		$this->get_settings();

		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );

	}

	/**
	 * Get settings from database and set as class property.
	 *
	 * @since 0.1.0
	 */
	private function get_settings() {

		$this->settings = get_option( 'basepress' );

	}

	/**
	 * Update settings option in databse.
	 *
	 * @since 0.1.0
	 */
	private function save_settings() {

		update_option( 'basepress', $this->settings, 'yes' );

	}

	/**
	 * Add single setting.
	 *
	 * @param $name string Setting name
	 * @param $value string Setting value
	 * @since 0.1.0
	 */
	public function add_setting( $name, $value ) {

		$this->settings[ $name ] = $value;
		$this->save_settings();

	}

	/**
	 * Remove single setting.
	 *
	 * @param $name string Setting name
	 * @since 0.1.0
	 */
	public function remove_setting( $name ) {

		unset( $this->settings[ $name ] );
		$this->save_settings();

	}

	public function add_settings_page() {

		add_options_page(
			'Manage Features',
			'Features',
			'manage_options',
			'basepress',
			array( $this, 'render_settings_page' )
		);

	}

	public function render_settings_page() {
		?>

		<div class="wrap">
			<h2>Manage Features</h2>

		</div>
		<?php
	}

}

/**
 * Instantiate the main class and initialize the plugin.
 *
 * @since 0.1.0
 */
new Basepress();
