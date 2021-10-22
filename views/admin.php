<?php namespace F13\GoogleMaps\Views;

class Admin
{
    public $label_all_wordpress_plugins;
    public $label_plugins_by_f13;

    public function __construct($params = array())
    {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }

        $this->label_all_wordpress_plugins = __('All WordPress Plugins', 'f13-google-maps');
        $this->label_plugins_by_f13 = __('Plugins by F13', 'f13-google-maps');
    }

    public function f13_settings()
    {
        $response = wp_remote_get('https://f13dev.com/f13-plugins/');
        $response = wp_remote_get('https://pluginlist.f13.dev');
        $body     = wp_remote_retrieve_body( $response );
        $v = '<div class="wrap">';
            $v .= '<h1>'.$this->label_plugins_by_f13.'</h1>';
            $v .= '<div id="f13-plugins">'.$body.'</div>';
            $v .= '<a href="'.admin_url('plugin-install.php').'?s=f13dev&tab=search&type=author">'.$this->label_all_wordpress_plugins.'</a>';
        $v .= '</div>';

        return $v;
    }

    public function google_maps_settings()
    {
        $v = '<div class="wrap">';
            $v .= '<h1>'.__('F13 Google Maps Settings', 'f13-google-maps').'</h1>';
            $v .= '<p>Welcome to the settings page for Google Maps Shortcode.</p>';
            $v .= '<p>This plugin requires a Google Maps API key to function</p>';
            $v .= '<h3>To obtain a Google maps API key:</h3>';
            $v .= '<ol>';
                $v .= '<li>Log-in to your Google account or register if you do not have one.</li>';
                $v .= '<li>Visit <a href="https://console.developers.google.com/apis/credentials">https://console.developers.google.com/apis/credentials</a>.</li>';
                $v .= '<li>Click the \'Generate credentials\' button at the top of the page/</li>';
                $v .= '<li>Select \'API Key\' from the dropdown menu.</li>';
                $v .= '<li>Select \'Browser Key\'.</li>';
                $v .= '<li>Enter a name for your API access, such as \'My Blog\'.</li>';
                $v .= '<li>Enter the URL to your blog, such as \'myblog.com\', if you receive an API Error, try leaving this field blank.</li>';
                $v .= '<li>Click \'Create\'.</li>';
                $v .= '<li>Copy and paste your API Key to the field below.</li>';
            $v .= '</ol>';

            $v .= '<form method="post" action="options.php">';
                $v .= '<input type="hidden" name="option_page" value="'.esc_attr('f13-gms-settings-group').'">';
                $v .= '<input type="hidden" name="action" value="update">';
                $v .= '<input type="hidden" id="_wpnonce" name="_wpnonce" value="'.wp_create_nonce('f13-gms-settings-group-options').'">';
                do_settings_sections('f13-gms-settings-group');
                $v .= '<table class="form-table">';
                    $v .= '<tr valign="top">';
                        $v .= '<th scope="row">'.__('API Key', 'f13-google-maps').'</th>';
                        $v .= '<td>';
                            $v .= '<input type="password" name="google_maps_api_key" value="'.esc_attr(get_option('google_maps_api_key')).'" style="width: 50%">';
                        $v .= '</td>';
                    $v .= '</tr>';
                $v .= '</table>';
                $v .= '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>';
            $v .= '</form>';

            $v .= '<h3>Shortcode example</h3>';
            $v .= '<p>If you wish to display a map to Harrod, London:<br>[googlemap building="87-135" road="Brompton road" town="London" country="UK"]</p>';
            $v .= '<p>Alternatively you could use the shortcode:<br>[googlemap building="Harrods" town="London"]</p>';
        $v .= '</div>';

        return $v;
    }
}