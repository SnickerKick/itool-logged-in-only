<?php
/*
Plugin Name: Insight Tools Logged In Only
Plugin URI: https://github.com/SnickerKick/itool-logged-in-only
Description: Only allow logged in users to access the site
Author: Insight Tools
Version: 1.0
Author URI: https://www.insight-tools.com
License: GPLv2
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function logged_in_only() {
	if ( ! is_user_logged_in() && ! is_page( esc_attr( get_option('not-logged-page') ))) {
		wp_redirect( get_option( 'not-logged-page' ));
                exit();
	}
}
add_action( 'template_redirect', 'logged_in_only' );

add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
    // Create the options page
    add_options_page( 'Logged In Only Options', 'Logged In Only', 'manage_options', 'itool-logged-in-only-options', 'my_plugin_options_page' );
        
    // Call register settings function
    add_action( 'admin_init', 'register_plugin_settings');
}

function register_plugin_settings() {
    // register the plugin's settings
    register_setting('itool-settings-group', 'not-logged-page');
}

/** Step 3. */
function my_plugin_options_page() {
    if ( !current_user_can( 'manage_options' ) )  {
    	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
?>
<div class="wrap">
<h1>Logged In Only Options</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'itool-settings-group' ); ?>
    <?php do_settings_sections( 'itool-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Page to display if not logged in</th>
        <td><input type="text" name="not-logged-page" value="<?php echo esc_attr( get_option('not-logged-page') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>