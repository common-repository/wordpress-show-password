<?php
/*
Plugin Name: WordPress Show Password
Plugin URI: http://weupnorth.com/plugins/wordpress-show-password
Description: Adds the possibility to show your password in plain text with a checkbox on the WordPress Login Screen.
Version: 1.1
Author: Andreas Karman
Author URI: http://andreaskarman.se

Copyright 2011  Andreas Karman
Copyright 2008  Andreas Lagerkvist

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
*/

/**
 * Get Plugin Path
 */
$showpasswordpluginpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'';

/**
 * i8n
 */

load_plugin_textdomain( 'wp-show-password', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
$i8n_sp = __('Show Password','wp-show-password');

/**
 * Load Javascript Files
 */

function showpass_js(){
	global $showpasswordpluginpath;
	global $i8n_sp;
	wp_register_script('showpass', $showpasswordpluginpath . '/js/jquery.showPassword.mod.js', array('jquery'));
	wp_enqueue_script( 'showpass');
	wp_localize_script('showpass', 'phpSettings', array(
	    'i8n_sp'   => $i8n_sp
	    ));
}
add_action( 'login_enqueue_scripts', 'showpass_js' );

/**
 * Load Javascript Code
 */

function showpassword() {
?>	
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('#loginform').showPassword();
});
</script>
<?php }
 
add_action('login_head', 'showpassword');
