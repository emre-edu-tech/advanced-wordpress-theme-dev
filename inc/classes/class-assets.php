<?php
/**
 * Enqueue theme assets
 * 
 * @package LimitlessWP
 */

namespace LimitlessWP_Theme\Inc;

use LimitlessWP_Theme\Inc\Traits\Singleton;

class Assets {
    // Use Singleton basically for every class to gurantee that the current class has been instantiated
    // only once
    use Singleton;

    public function __construct() {
        // action and filters for this class
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Actions
        add_action('wp_enqueue_scripts', [$this, 'register_styles']);
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    }

    public function register_styles() {
        // enqueue theme style using get_template_directory_uri()
        // wp_enqueue_style('limitlesswp-main-styles', get_template_directory_uri() . '/style.css', [], '1.0', 'all');
        // enqueue theme style using get_stylesheet_directory_uri()
        // wp_enqueue_style('limitlesswp-main-styles', get_stylesheet_directory_uri() . '/style.css', [], '1.0', 'all');
        // enqueue theme style using get_stylesheet_uri()
        // IMPORTANT NOTE: filemtime() should be used while development
        // Register Styles
        wp_register_style('limitlesswp-bootstrap-styles', LIMITLESSWP_URI_PATH . '/assets/src/library/css/bootstrap.min.css', [], '5.2', 'all');
        wp_register_style('limitlesswp-main-styles', get_stylesheet_uri(), [], filemtime(LIMITLESSWP_DIR_PATH . '/style.css'), 'all');
        wp_register_style('limitlesswp-font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css', [], '6.2', 'all');

        // Enqueue Styles
        wp_enqueue_style('limitlesswp-font-awesome');
        wp_enqueue_style('limitlesswp-bootstrap-styles');
        wp_enqueue_style('limitlesswp-main-styles');
    }

    public function register_scripts() {
        // Register Scripts
        // Bootstrap 5 removed the jQuery dependency
        wp_register_script('limitlesswp-bootstrap-script', LIMITLESSWP_URI_PATH . '/assets/src/library/js/bootstrap.min.js', [], '5.2', true);
        wp_register_script('limitlesswp-main-script', LIMITLESSWP_URI_PATH . '/assets/main.js', [], filemtime(LIMITLESSWP_DIR_PATH . '/assets/main.js'), true);

        // Enqueue Scripts
        wp_enqueue_script('limitlesswp-bootstrap-script');
        wp_enqueue_script('limitlesswp-main-script');
    }
}