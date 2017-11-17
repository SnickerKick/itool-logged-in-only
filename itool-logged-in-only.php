<?php
/*
Plugin Name: Insight Tools Logged In Only
Plugin URI: https://github.com/SnickerKick/itool-logged-in-only
Description: Only allow logged in users to access the site
Author: Insight Tools
Version: 0.1
Author URI: https://www.insight-tools.com
License: GPLv2
*/

function logged_in_only() {
	if ( ! is_user_logged_in() ) {
		auth_redirect();
	}
}
add_action( 'template_redirect', 'logged_in_only' );
