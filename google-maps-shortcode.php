<?php
/*
Plugin Name: Google Maps Shortcode
Plugin URI: http://f13dev.com/wordpress-plugin-google-maps-shortcode/
Description: Add a Google Maps reference to your WordPress website using shortcode
Version: 1.0
Author: Jim Valentine - f13dev
Author URI: http://f13dev.com
Text Domain: f13-google-maps-shortcode
License: GPLv3
*/

/*
Copyright 2016 James Valentine - f13dev (jv@f13dev.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/
add_shortcode( 'wpplugin', 'f13_google_maps_shortcode');
// Register the css
add_action( 'wp_enqueue_scripts', 'f13_google_maps_shortcode_stylesheet');

function f13_google_maps_shortcode( $atts, $content = null )
{
  // Create the shortcode
}

function f13_google_maps_shortcode_stylesheet()
{
    // Register the stylesheet and enqueu it it load
    wp_register_style( 'f13maps-style', plugins_url('google-maps-shortcode.css', __FILE__));
    wp_enqueue_style( 'f13maps-style' );
}
