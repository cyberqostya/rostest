<?php
/**
 * Plugin Name: MY_DOCTORS
 * Description: Custom post type Doctors with taxonomies, meta fields and filters.
 * Version: 1.0
 * Author: Konstantin
 * Text Domain: my_doctors
 */

if (!defined('ABSPATH')) {
  exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/cpt-doctors.php';
require_once plugin_dir_path(__FILE__) . 'includes/taxonomies.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-fields.php';
require_once plugin_dir_path(__FILE__) . 'includes/query-modifiers.php';

function my_doctors_enqueue_styles()
{
  wp_enqueue_style(
    'my-doctors-styles',
    plugin_dir_url(__FILE__) . 'assets/css/style.css',
    array(),
    '1.0'
  );
}
add_action('wp_enqueue_scripts', 'my_doctors_enqueue_styles');