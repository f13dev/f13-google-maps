# F13 Google Maps Shortcode
Add a Google Maps map to your WordPress powered website using shortcode

# Plugin Details
Website: https://f13.dev/wordpress-plugin-google-maps-shortcode/
Tags: google maps, maps, plugin, api, shortcode
Requires WP Version: 3.0.1
Tested up to WP Version: 5.8.1
Stable tag: 2.0.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

# Description
Using F13 Google Maps Shortcode you can simply embed a secton of Google Maps into your WordPress powered website using shortcode.

In order to use this plugin you will require a Google Maps API Key, of which instructions for obtaining one are in the admin panel.

Features include:

* Cached using Transient to save PHP server load (Maps are still called from Google on each page load)
* Maps can be generated using a combination of: Building, Road, Town and Country
* Requires a Google Maps API Key, full instructions are provided in the admin panel

# Installation

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Visit the admin page in the WordPress admin panel: Settings => F13 Google Maps Shortcode.
4. Get an API Key by following the instructions in the admin panel.
5. Paste your admin key into the appropriate field in the admin panel: Settings =>F13 Google Maps Shortcode.
6. Add the shortcode [googlemap building="name or number" road="a road" town="a town" country="a country"] to the desired location on your blog.


# FAQ

Q) How do I get a Google Maps API Key

A) Full instructions are provided on the F13 Google Maps Shortcode settings page.
Settings => F13 Google Maps Settings

# Screenshot

![An example showing the Google Maps Shortcode  in use.](/screenshot-1.png?raw=true "Google Maps Shortcode")

The results of adding [googlemap building="Harrods" town="London"] to a blog post.

# Changelog

1.0
* Initial release

2.0.0
* Refactoring into MVC layout
* Responsive maps
* Modernising codebase
