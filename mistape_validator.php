<?php
/*
Plugin Name: Mistape Validator
Description: Mistape Validator allows to effortlessly validate Mistape submission
Version: 1.0
Author: Sohel Zerdoumi
License: MIT License
License URI: http://opensource.org/licenses/MIT
Text Domain: mistape
*/
if (!defined('ABSPATH')) {
    exit;
}
define('MV_PATH_TEMPLATE', __DIR__ . '/templates/');

require_once __DIR__ . '/autoload.php';

class MistapeValidatorPlugin
{
    private $mistapeController;

    public function init()
    {
        $this->mistapeController = new \MistapeValidator\Controller();
        add_action('wp_ajax_mistape_accept', [$this->mistapeController, 'acceptMistape']);
        add_action('wp_ajax_mistape_reject', [$this->mistapeController, 'rejectMistape']);


        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script('ajax-script', plugins_url('/assets/script.js', __FILE__), array('jquery'));
        wp_enqueue_style('mistape_validator', plugins_url('/assets/style.css', __FILE__));
    }

    public function admin_menu()
    {
        add_management_page('Mistape Validator', 'Mistape Validator', 'edit_posts', 'mistape_list', array($this->mistapeController, 'run'));
    }
}


function mistape_validator_init()
{
    if (current_user_can('edit_posts')) {
        $mistapeValidator = new MistapeValidatorPlugin();
        $mistapeValidator->init();
    }
}

add_action('plugins_loaded', 'mistape_validator_init');
