<?php

if (!defined('ABSPATH')) {
  exit;
}

function my_doctors_archive_posts_per_page($query)
{

  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  if ($query->is_post_type_archive('doctors')) {

    // Сброс пагинации при задании фильтра
    $query->set('paged', 1);

    // ТЗ: вывод по 9 элементов на страницу
    $query->set('posts_per_page', 9);

    // Фильтр по специализации
    if (!empty($_GET['specialization'])) {
      $term = sanitize_text_field($_GET['specialization']);
      $query->set('tax_query', array(
        array(
          'taxonomy' => 'specialization',
          'field' => 'slug',
          'terms' => $term,
        )
      ));
    }

    // Фильтр по городу
    if (!empty($_GET['city'])) {
      $term = sanitize_text_field($_GET['city']);
      $tax_query = $query->get('tax_query') ?: array();
      $tax_query[] = array(
        'taxonomy' => 'city',
        'field' => 'slug',
        'terms' => $term,
      );
      $query->set('tax_query', $tax_query);
    }

    // Сортировка
    if (!empty($_GET['sort'])) {
      switch ($_GET['sort']) {
        case 'rating_desc':
          $query->set('meta_key', 'rating');
          $query->set('orderby', 'meta_value_num');
          $query->set('order', 'DESC');
          break;

        case 'price_asc':
          $query->set('meta_key', 'price_from');
          $query->set('orderby', 'meta_value_num');
          $query->set('order', 'ASC');
          break;

        case 'experience_desc':
          $query->set('meta_key', 'experience');
          $query->set('orderby', 'meta_value_num');
          $query->set('order', 'DESC');
          break;
      }
    }
  }
}

add_action('pre_get_posts', 'my_doctors_archive_posts_per_page');
