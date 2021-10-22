<?php namespace F13\GoogleMaps\Views;

class Shortcode
{
    public $api_key;

    public function __construct($params = array())
    {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }

        $this->api_key = esc_attr(get_option('google_maps_api_key'));
    }

    public function google_maps()
    {
        $v = '<div class="f13-google-maps-container">';
            $v .= '<iframe ';
                $v .= 'src="https://www.google.com/maps/embed/v1/place?q='.$this->map_search.'&key='.$this->api_key.'" ';
            $v .= '></iframe>';
        $v .= '</div>';

        return $v;
    }
}