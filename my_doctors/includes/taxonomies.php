<?php

if (!defined('ABSPATH')) {
  exit;
}

function my_doctors_register_taxonomies()
{

  $spec_labels = array(
    'name' => __('Специализации', 'my_doctors'),
    'singular_name' => __('Специализация', 'my_doctors'),
    'search_items' => __('Искать специализации', 'my_doctors'),
    'all_items' => __('Все специализации', 'my_doctors'),
    'parent_item' => __('Родительская специализация', 'my_doctors'),
    'parent_item_colon' => __('Родительская специализация:', 'my_doctors'),
    'edit_item' => __('Редактировать специализацию', 'my_doctors'),
    'update_item' => __('Обновить специализацию', 'my_doctors'),
    'add_new_item' => __('Добавить специализацию', 'my_doctors'),
    'new_item_name' => __('Новое название специализации', 'my_doctors'),
    'menu_name' => __('Специализации', 'my_doctors'),
  );

  register_taxonomy(
    'specialization',
    array('doctors'),
    array(
      'hierarchical' => true,
      'labels' => $spec_labels,
      'show_ui' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'specialization'),
    )
  );

  $city_labels = array(
    'name' => __('Города', 'my_doctors'),
    'singular_name' => __('Город', 'my_doctors'),
    'search_items' => __('Искать города', 'my_doctors'),
    'all_items' => __('Все города', 'my_doctors'),
    'edit_item' => __('Редактировать город', 'my_doctors'),
    'update_item' => __('Обновить город', 'my_doctors'),
    'add_new_item' => __('Добавить город', 'my_doctors'),
    'new_item_name' => __('Новое название города', 'my_doctors'),
    'menu_name' => __('Города', 'my_doctors'),
  );

  register_taxonomy(
    'city',
    array('doctors'),
    array(
      'hierarchical' => false,
      'labels' => $city_labels,
      'show_ui' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'city'),
    )
  );
}

add_action('init', 'my_doctors_register_taxonomies');
