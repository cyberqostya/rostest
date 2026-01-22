<?php

if (!defined('ABSPATH')) {
  exit;
}

function my_doctors_register_cpt()
{

  $labels = array(
    'name' => __('Доктор', 'my_doctors'),
    'singular_name' => __('Доктор', 'my_doctors'),
    'menu_name' => __('Доктор', 'my_doctors'),
    'name_admin_bar' => __('Доктор', 'my_doctors'),
    'add_new' => __('Добавить', 'my_doctors'),
    'add_new_item' => __('Добавить доктора', 'my_doctors'),
    'new_item' => __('Новый доктор', 'my_doctors'),
    'edit_item' => __('Редактировать доктора', 'my_doctors'),
    'view_item' => __('Посмотреть доктора', 'my_doctors'),
    'all_items' => __('Все доктора', 'my_doctors'),
    'search_items' => __('Искать доктора', 'my_doctors'),
    'not_found' => __('Доктора не найдены', 'my_doctors'),
    'not_found_in_trash' => __('Доктора в корзине не найдены', 'my_doctors'),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'doctors'),
    'menu_position' => 5,
    'menu_icon' => 'dashicons-businessperson',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'show_in_rest' => true,
  );

  register_post_type('doctors', $args);
}

add_action('init', 'my_doctors_register_cpt');
