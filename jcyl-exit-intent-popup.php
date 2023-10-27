<?php
/*
Plugin Name: Exit Intent Popup
Description: A plugin that emulates an exit intent popup on all pages of the website
Version: 1.0
Author: John Cris Lasta
*/

define('JCYL_EIP_TEMPLATES_DIR',    plugin_dir_path(__FILE__) . 'templates/');
define('JCYL_EIP_ASSETS_URL',       plugin_dir_url(__FILE__) . 'assets/');

// Set the content template here, you can build your templates in the templates folder
//const JCYL_EIP_DEFAULT_TEMPLATE = 'sample';
const JCYL_EIP_DEFAULT_TEMPLATE = 'convertflow-exit-intent-popup-example';

// Set the number of days for cache clearance
//const JCYL_EIP_CACHE_CLEARANCE_DAYS = 0.00001157; // Use this to test popup. It clears the cache every second.
const JCYL_EIP_CACHE_CLEARANCE_DAYS = 30;

function add_exit_intent_popup_script() {
    // Enqueue jQuery and your custom JavaScript file
    wp_enqueue_script('jquery');
    wp_register_script('exit-intent-popup', JCYL_EIP_ASSETS_URL . 'js/exit-intent-popup.js', array('jquery'), '1.0', true);
    // Pass the cache clearance days variable to the JavaScript file
    wp_localize_script('exit-intent-popup', 'jcyl_eip', [ 'cacheClearanceDays' => JCYL_EIP_CACHE_CLEARANCE_DAYS]);
    wp_enqueue_script('exit-intent-popup');

    // Enqueue the CSS file for the exit-intent popup styles
    wp_enqueue_style('exit-intent-popup-styles', JCYL_EIP_ASSETS_URL . 'css/exit-intent-popup.css');


    if ( JCYL_EIP_DEFAULT_TEMPLATE == 'convertflow-exit-intent-popup-example' ) {
        // Enqueue the CSS file for the convertflow-exit-intent-popup-example styles
        wp_enqueue_style('convertflow-exit-intent-popup-example', JCYL_EIP_ASSETS_URL . 'css/convertflow-exit-intent-popup-example.css');
    }

}

function add_exit_intent_popup_html() {
    // Add the HTML for the exit-intent popup
    echo '<div id="exit_intent_popup" style="display: none;">
            <div id="exit_intent_popup__content">';
    include(JCYL_EIP_TEMPLATES_DIR . JCYL_EIP_DEFAULT_TEMPLATE . '.php');
    echo    '</div>
            <div id="exit_intent_popup__background" class="exit_intent_popup__close"></div>
        </div>';
}

add_action('wp_enqueue_scripts', 'add_exit_intent_popup_script');
add_action('wp_footer', 'add_exit_intent_popup_html');