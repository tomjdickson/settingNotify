<?php

// Plugin Information

/**
 * @package settingNotify
 * @version 1.0.0
 */
/*
 Plugin Name: settingNotify
 Plugin URI: https://tomdickson.io/wp/plugins/settingnotify
 Description: This plugin is designed to notify administators when a setting has been changed in a wordpress instance.
 Author: Tom Dickson
 Version: 1.0.0
 Author URI: https://tomdickson.io
 license: MIT
 Text Domain: settingNotify
*/

// If plugin is published, put license information in a comment block above me.

defined('ABSPATH') or die('You are not allowed to access this file');

class SettingNotify 
{
    public $plugin_name;


    // Basic Methods 
    function __construct() {
        $this->plugin_name = plugin_basename(__FILE__);
    }

    function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
        add_action('admin_menu', array($this, 'admin_pages'));
        add_filter("plugin_action_links_$this->plugin_name", array($this, 'settings_link'));
    }

    protected function create_post_type() {
        add_action( 'init', array( $this, 'custom_post_type' ) );
    }

    public function settings_link($links){
        $settings_link = '<a href="admin.php?page=settingsNotify_admin">Notification Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }

    function custom_post_type() {
        register_post_type('check', ['public' => true, 'label' => 'Notifications']);
    }

    function enqueue() {
        // Enqueue all Assets
        // CSS
        wp_enqueue_style('pluginstyle', plugins_url('/assets/style.css', __FILE__) );
        wp_enqueue_script('pluginscript', plugins_url('/assets/custom.js', __FILE__) );
    }

    public function admin_pages() {
        add_menu_page('Notification Settings', 'Notification Settings', 'manage_options', 'settingsNotify_admin', array($this, 'admin_settings'), 'dashicons-controls-volumeon', 110 );
    }

    public function admin_settings() {
        // require template
        require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
    }

    function activate() {
        require_once plugin_dir_path(__FILE__) . 'includes/pluginActivate.php';
        settingNotifyActivate::activate();
    }

    function deactivate() {
        require_once plugin_dir_path(__FILE__) . 'includes/pluginDeactivate.php';
        settingNotifyDeactivate::deactivate();
    }

}

// Checking if the class exists, then if it does create a new instance
if ( class_exists('SettingNotify') ) {
    $settingNotify = new SettingNotify( 'Plugin initialised: date and time' );
    $settingNotify->register();
}

function newCheck($checkTitle, $checkDesciption, $checkReceipient, $checkEvent ) {

}

// Activation

register_activation_hook(__FILE__, array($settingNotify, 'activate') );

// Deactivation

register_deactivation_hook(__FILE__, array($settingNotify, 'deactivate') );


