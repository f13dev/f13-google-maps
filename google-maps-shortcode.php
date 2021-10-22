<?php
/*
Plugin Name: F13 Google Maps
Plugin URI: https://f13.dev/wordpress-plugin-google-maps-shortcode/
Description: Embed google maps into your website with shortcodes
Version: 2.0.0
Author: f13dev
Author URI: http://f13.dev
Text Domain: f13-google-maps
License: GPLv3
*/

namespace F13\GoogleMaps;

if (!function_exists('get_plugins')) require_once(ABSPATH.'wp-admin/includes/plugin.php');
if (!defined('F13_GOOGLE_MAPS')) define('F13_GOOGLE_MAPS', get_plugin_data(__FILE__, false, false));
if (!defined('F13_GOOGLE_MAPS_PATH')) define('F13_GOOGLE_MAPS_PATH', realpath(plugin_dir_path( __FILE__ )));
if (!defined('F13_GOOGLE_MAPS_URL')) define('F13_GOOGLE_MAPS_URL', plugin_dir_url(__FILE__));

class Plugin
{
    public function init()
    {
        spl_autoload_register(__NAMESPACE__.'\Plugin::loader');
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));

        $c = new Controllers\Control();

        if (is_admin()) {
            $a = new Controllers\Admin();
        }
    }

    public static function loader($name)
    {
        $name = trim(ltrim($name, '\\'));
        if (strpos($name, __NAMESPACE__) !== 0) {
            return;
        }
        $file = str_replace(__NAMESPACE__, '', $name);
        $file = ltrim(str_replace('\\', DIRECTORY_SEPARATOR, $file), DIRECTORY_SEPARATOR);
        $file = plugin_dir_path(__FILE__).strtolower($file).'.php';

        if ($file !== realpath($file) || !file_exists($file)) {
            wp_die('Class not found: '.htmlentities($name));
        } else {
            require_once $file;
        }
    }

    public function enqueue()
    {
        wp_enqueue_style('f13-google-maps', F13_GOOGLE_MAPS_URL.'css/google-maps.css', array(), F13_GOOGLE_MAPS['Version']);
    }
}

$p = new Plugin();
$p->init();