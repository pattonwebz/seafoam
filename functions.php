<?php
 /**
  * The functions.php file of the 'Seafoam' child theme of 'Best Reloaded' theme.
  *
  * @package Best Reloaded
  * @subpackage Seafoam
  */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue this themes and set parent theme styles as dependancies.
 */
function seafoam_enqueue_css() {
	wp_enqueue_style( 'seafoam', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'best-reloaded', 'font-awesome' ) );
}
add_action( 'wp_enqueue_scripts', 'seafoam_enqueue_css' );

/**
 * Filters the upsell values in the customizer.
 *
 * This is a strait override, not truly a filter.
 *
 * @param  array $upsell_values An array of existing upsell values.
 *
 * @return array                Updated array of upsell values.
 */
function seafoam_filter_upsell_values( $upsell_values ) {
	// Start a buffer to hold some html content.
	ob_start(); ?>
	<p><?php esc_html_e( 'I hate crippleware and lite versions. This is the full theme.', 'seafoam' ); ?></p>
	<p><?php esc_html_e( 'You can contact me for support or customizations.', 'seafoam' ); ?></p>
	<hr>
	<p><?php esc_html_e( 'If you like this theme consider giving it a ', 'seafoam' ); ?><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/seafoam/reviews/ ' ); ?>" target="_blank"><?php esc_html_e( '5 star rating', 'seafoam' ); ?></a>.</p>
	<?php
	// get the buffered content.
	$description = ob_get_clean();
	// start a holder array.
	$upsell_values = array(
		'title'    => esc_html__( 'Seafoam', 'seafoam' ),
		'pro_text' => esc_html__( 'Help and Support',         'seafoam' ),
		'pro_url'  => esc_url( 'https://www.pattonwebz.com/contact-me/' ),
		'pro_description' => $description,
		'priority'   => 10,
	);
	return $upsell_values;
}
add_filter( 'best_reloaded_filter_upsell_values', 'seafoam_filter_upsell_values', 10, 1 );


/**
 * Filters the title of the main customizer panel to match our theme name.
 *
 * @param  string $title Current panel title.
 *
 * @return string        Updated panel title.
 */
function seafoam_filter_theme_settings_panel_title( $title ) {
	$title = __( 'Seafoam Theme Settings', 'seafoam' );
	return $title;
}
add_filter( 'best_reloaded_filter_theme_settings_panel_title', 'seafoam_filter_theme_settings_panel_title', 10, 1 );

/**
 * Filter the default values that are passed to the customizer object.
 *
 * @param array $defaults An array of mixed type key=>value data.
 *
 * @return array          updated array of values
 */
function seafoam_filter_setting_defaults( $defaults ) {
	$defaults['navbar-color'] = 'navbar-dark';
	$defaults['navbar-bg']    = 'bg-primary';
	$defaults['search_color'] = 'btn-dark';
	// return the updated array of default values.
	return $defaults;
}
add_filter( 'best_reloaded_filter_setting_defaults', 'seafoam_filter_setting_defaults', 10, 1 );

/**
 * Performs various setup actions for the theme.
 */
function seafoam_setup() {
	// Set the default background color for use in the theme. This overrules
	// the same support added in the parent theme.
	$custom_bg_args = array(
			'default-color' => '1558a5',
	);
	add_theme_support( 'custom-background', $custom_bg_args );
}
add_action( 'after_setup_theme', 'seafoam_setup' );
