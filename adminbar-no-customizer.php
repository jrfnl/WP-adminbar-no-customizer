<?php
/**
 * Adminbar No Customizer.
 *
 * @package     WordPress\Plugins\Adminbar No Customizer
 * @author      Juliette Reinders Folmer <wpplugins_nospam@adviesenzo.nl>
 * @link        https://github.com/jrfnl/WP-adminbar-no-customizer
 * @version     1.0.1
 *
 * @copyright   2015-2020 Juliette Reinders Folmer
 * @license     http://creativecommons.org/licenses/GPL/2.0/ GNU General Public License, version 2 or higher
 *
 * @wordpress-plugin
 * Plugin Name: Adminbar No Customizer
 * Plugin URI:  http://wordpress.org/plugins/adminbar-no-customizer/
 * Description: Moves the Customizer link from the Adminbar top level to be a subitem under the site-menu.
 * Version:     1.0.1
 * Author:      Juliette Reinders Folmer
 * Author URI:  http://www.adviesenzo.nl/
 * Copyright:   2015-2020 Juliette Reinders Folmer
 */

// Avoid direct calls to this file.
if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( ! function_exists( 'adminbar_no_customizer' ) ) {
	/**
	 * Move the Customizer link from the Adminbar top-level to be a sub-item under the site-menu.
	 *
	 * @param object $wp_admin_bar The admin bar object. Gets passed by reference.
	 *
	 * @return void
	 */
	function adminbar_no_customizer( $wp_admin_bar ) {

		$node = $wp_admin_bar->get_node( 'customize' );

		// Check if the customizer node exists.
		if ( $node ) {
			$args         = $node;
			$args->parent = 'appearance';
			$wp_admin_bar->add_node( $args );
		}
	}
	add_action( 'admin_bar_menu', 'adminbar_no_customizer', 1000 );
}

if ( ! function_exists( 'adminbar_no_customizer_no_icon' ) ) {
	/**
	 * Remove the icon from the customizer item once moved to the submenu.
	 *
	 * @return void
	 */
	function adminbar_no_customizer_no_icon() {
		echo '<style type="text/css">#wpadminbar #wp-admin-bar-customize > .ab-item:before { content: normal; }</style>';
	}
	add_action( 'wp_print_footer_scripts', 'adminbar_no_customizer_no_icon' );
}
