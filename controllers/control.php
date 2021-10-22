<?php namespace F13\GoogleMaps\Controllers;

class Control
{
    public function __construct()
    {
        add_shortcode('googlemap', array($this, 'google_maps_shortcode'));
    }

    public function google_maps_shortcode($atts = array())
    {
        extract(shortcode_atts(array('building' => '', 'road' => '', 'town' => '', 'country' => '', 'width' => '', 'height' => ''), $atts));

        if (empty($building) && empty($road) && empty($town)) {
            return '<div class="f13-google-maps-error">'.__('At least one or more attributes must be set for: building, road or town.', 'f13-google-maps').'</div>';
        }

        $map_search = str_replace('&', '', $building.' '.$road.' '.$town.' '.$country);

        $v = new \F13\GoogleMaps\Views\Shortcode(array(
            'map_search' => $map_search,
        ));

        return $v->google_maps();
    }
}