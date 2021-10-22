<?php namespace F13\GoogleMaps\Controllers;

class Admin
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function admin_menu()
    {
        global $menu;
        $exists = false;
        foreach ($menu as $item) {
            if (strtolower($item[0]) == strtolower('F13 Admin')) {
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            add_menu_page( 'F13 Settings', 'F13 Admin', 'manage_options', 'f13-settings', array($this, 'f13_settings'), 'dashicons-embed-generic', 4);
            add_submenu_page( 'f13-settings', 'Plugins', 'Plugins', 'manage_options', 'f13-settings', array($this, 'f13_settings'));
        }
        add_submenu_page( 'f13-settings', 'Google Maps Settings', 'Google Maps', 'manage_options', 'f13-google-maps', array($this, 'f13_google_maps_settings'));
    }

    public function f13_google_maps_settings()
    {
        $v = new \F13\GoogleMaps\Views\Admin();

        echo $v->google_maps_settings();
    }

    public function f13_settings()
    {
        $v = new \F13\GoogleMaps\Views\Admin();

        echo $v->f13_settings();
    }

    public function register_settings()
    {
        register_setting('f13-gms-settings-group', 'google_maps_api_key');
    }
}