<?php
/**
 * Kadence functions and definitions
 *
 * This file must be parseable by PHP 5.2.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kadence
 */

define( 'KADENCE_VERSION', '1.2.16' );
define( 'KADENCE_MINIMUM_WP_VERSION', '6.0' );
define( 'KADENCE_MINIMUM_PHP_VERSION', '7.4' );

// Bail if requirements are not met.
if ( version_compare( $GLOBALS['wp_version'], KADENCE_MINIMUM_WP_VERSION, '<' ) || version_compare( phpversion(), KADENCE_MINIMUM_PHP_VERSION, '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
// Include WordPress shims.
require get_template_directory() . '/inc/wordpress-shims.php';

// Load the `kadence()` entry point function.
require get_template_directory() . '/inc/class-theme.php';

// Load the `kadence()` entry point function.
require get_template_directory() . '/inc/functions.php';
// Load the gallery page function.
require get_template_directory() . '/inc/gallery-functions.php';
// Initialize the theme.
call_user_func( 'Kadence\kadence' );

// Disable updates for this theme.
add_filter( 'site_transient_update_themes', 'disable_kadence_theme_update' );
function disable_kadence_theme_update( $value ) {
	if ( isset( $value->response['kadence'] ) ) {
		unset( $value->response['kadence'] );
	}
	return $value;
}

// Load custom quote form shortcode and AJAX submission handler
require get_template_directory() . '/inc/custom-quote-form.php';

// Enqueue scripts and styles for custom landing page template
function kadence_landing_page_assets() {
	if ( is_page_template( 'page-templates/custom-landing-page.php' ) ) {
		// Enqueue Minified CSS
		wp_enqueue_style(
			'kadence-landing-min-style',
			get_template_directory_uri() . '/assets/landing-page/dist/css/landing-min.css',
			array(),
			KADENCE_VERSION
		);

		// Enqueue Minified JS
		wp_enqueue_script(
			'kadence-landing-min-script',
			get_template_directory_uri() . '/assets/landing-page/dist/js/landing-min.js',
			array(),
			KADENCE_VERSION,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'kadence_landing_page_assets', 100 );
