<?php
/*
Plugin Name: F13 Google Maps Shortcode
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
add_shortcode( 'googlemap', 'f13_google_maps_shortcode');
// Register the admin page
add_action('admin_menu', 'f13_gms_create_menu');

/**
 * Function to handle the shortcode
 * @param  Array  $atts    The attributes set in the shortcode
 * @param  [type] $content [description]
 * @return String          The response of the shortcode
 */
function f13_google_maps_shortcode( $atts, $content = null )
{
    // Get the attributes
    extract( shortcode_atts ( array (
        'building' => '', // Default building of null
        'road' => '', // Default road of null
        'town' => '', // Default town of null
        'country' => '', // Default country of null
        'width' => '100%', // Default width of 100%
        'height' => '400px', // Default height of 400px
        'cachetime' => '0' // Default cache time of 0
    ), $atts ));

    // Set the cache name for this instance of the shortcode
    $cache = get_transient('f13gms' . md5(serialize($atts)));

    // Check if the cache exists
    if ($cache)
    {
        // If the cache exists, return it rather than re-creating it
        return $cache;
    }
    else
    {
        // Multiply the cahce time by 60 to produce a time in minutes
        $cachetime = esc_attr( get_option('google_maps_cache_timeout')) * 60;
        // If the cachetime is 0, set it to one, otherwise the cache will never expire
        if ($cachetime == 0 || $cachetime == null)
        {
            $cachetime = 1;
        }
        // Check if a postcode has been entered
        if ($building == '' && $road == '' && $town == '')
        {
            // If no postcode has been entered, allert the user
            $string = 'At least one or more attributes must be set for: building, road or town.';
        }
        else
        {
            // Create the search string
            $mapSearch = $building . ' ' . $road . ' ' . $town . '' . $country;
            $mapSearch = str_replace('&', ' ', $mapSearch);
            // Set the testing string
            $string = '
            <iframe src="https://www.google.com/maps/embed/v1/place?q=' . $mapSearch . '&key=' . esc_attr( get_option('google_maps_api_key')) . '" style="width: ' . $width . '; height: ' . $height . ';"></iframe>';
            // Set the cache using the newly created string
            set_transient('f13gms' . md5(serialize($atts)), $string, $cachetime);
        }
        // Return the newly created string
        return $string;
    }

    // Create the shortcode
}

/**
 * A function to create the admin menu
 */
function f13_gms_create_menu()
{
    // Create the sub-level menu under settings
    add_options_page('F13Devs Google Maps Shortcode Settings', 'F13 Google Maps Shortcode', 'administrator', 'f13-google-maps-shortcode', 'f13_gms_settings_page');
    // Retister the Settings
    add_action( 'admin_init', 'f13_gms_settings');
}

/**
 * A function to register the plugin settings
 */
function f13_gms_settings()
{
    // Register settings for token and timeout
    register_setting( 'f13-gms-settings-group', 'google_maps_api_key');
    register_setting( 'f13-gms-settings-group', 'google_maps_cache_timeout');
}

/**
 * A function to create the admin settings page
 */
function f13_gms_settings_page()
{
?>
    <div class="wrap">
        <h2>Google Maps Settings</h2>
        <p>
            Welcome to the settings page for Google Maps Shortcode.
        </p>
        <p>
            This plugin requires a Google Maps API key to function
        </p>
        <p>
            <h3>To obtain a Google maps API key:</h3>
            <ol>
                <li>
                    Log-in to your Google account or register if you do not have one.
                </li>
                <li>
                    Visit <a href="https://console.developers.google.com/apis/credentials">https://console.developers.google.com/apis/credentials</a>.
                </li>
                <li>
                    Click the 'Generate credentials' button at the top of the page/
                </li>
                <li>
                    Select 'API Key' from the dropdown menu.
                </li>
                <li>
                    Select 'Browser Key'.
                </li>
                <li>
                    Enter a name for your API access, such as 'My Blog'.
                </li>
                <li>
                    Enter the URL to your blog, such as 'myblog.com', if you receive an API Error, try leaving this field blank.
                </li>
                <li>
                    Click 'Create'.
                </li>
                <li>
                    Copy and paste your API Key to the field below.
                </li>
            </ol>
        </p>

        <form method="post" action="options.php">
            <?php settings_fields( 'f13-gms-settings-group' ); ?>
            <?php do_settings_sections( 'f13-gms-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        Google Maps API Key:
                    </th>
                    <td>
                        <input type="password" name="google_maps_api_key" value="<?php echo esc_attr( get_option( 'google_maps_api_key' ) ); ?>" style="width: 50%;"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        Cache timeout (minutes):
                    </th>
                    <td>
                        <input type="number" name="google_maps_cache_timeout" value="<?php echo esc_attr( get_option( 'google_maps_cache_timeout' ) ); ?>" style="width: 75px;"/>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <h3>Shortcode example</h3>
        <p>
            If you wish to display a map to Harrod, London:<br />
            [googlemap building="87-135" road="Brompton road" town="London" country="UK"]
        </p>
        <p>
            Alternatively you could use the shortcode:<br />
            [googlemap building="Harrods" town="London"]
        </p>
    </div>
<?php
}
