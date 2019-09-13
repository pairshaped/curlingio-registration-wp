<?php
/*
Plugin Name: Curling I/O Registration Shortcodes
Plugin URI: https://curling.io/plugins/curlingio-wp/
Description: Adds shortcodes to display your Curling I/O leagues, competitions, and products. Valid sections are: "leagues", "competitions", and "products". You need to pass your Curling I/O subdomain. So if you Curling I/O instance is demo.curling.io then to display your leagues, the shortcode would be [curlingio section=leagues subdomain=demo]
Author: Curling I/O
Version: 1.0.0
Author URI: https://curling.io
*/

//[curlingio]

function curlingio_add_scripts(){
	wp_register_script('curlingio_main', 'https://pairshaped.github.io/curlingio-registration-widget/prod.min.js');
	wp_enqueue_script('curlingio_main');
}

add_action('wp_enqueue_scripts', 'curlingio_add_scripts');

function curlingio($atts) {
  $a = shortcode_atts( array(
		'subdomain' => 'demo',
    'section' => 'leagues'
  ), $atts );

  return "
    <div id='curlingio-" . esc_attr($a['section']) . "'></div>
      <script>
      Elm.Main.init({
        node: document.getElementById('curlingio-" . esc_attr($a['section']) . "'),
        flags: { host: 'https://" . esc_attr($a['subdomain']) . ".curling.io/en', section: '" . esc_attr($a['section']) . "' }
      })
    </script>
  ";
}

add_shortcode('curlingio', 'curlingio');
?>
