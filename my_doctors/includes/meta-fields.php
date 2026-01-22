<?php

if (!defined('ABSPATH')) {
  exit;
}

function my_doctors_add_meta_box()
{
  add_meta_box(
    'doctor_details',
    __('Данные доктора', 'my_doctors'),
    'my_doctors_render_meta_box',
    'doctors',
    'normal',
    'default'
  );
}
add_action('add_meta_boxes', 'my_doctors_add_meta_box');

function my_doctors_render_meta_box($post)
{

  wp_nonce_field('my_doctors_save_meta', 'my_doctors_nonce');

  $experience = get_post_meta($post->ID, 'experience', true);
  $price_from = get_post_meta($post->ID, 'price_from', true);
  $rating = get_post_meta($post->ID, 'rating', true);
  ?>

  <p>
    <label for="experience"><strong>Стаж врача</strong></label><br>
    <input type="number" id="experience" name="experience" value="<?php echo esc_attr($experience); ?>" min="0">
  </p>

  <p>
    <label for="price_from"><strong>Цена от</strong></label><br>
    <input type="number" id="price_from" name="price_from" value="<?php echo esc_attr($price_from); ?>" min="0">
  </p>

  <p>
    <label for="rating"><strong>Рейтинг (0–5)</strong></label><br>
    <input type="number" step="0.1" min="0" max="5" id="rating" name="rating" value="<?php echo esc_attr($rating); ?>">
  </p>

  <?php
}

function my_doctors_save_meta($post_id)
{

  if (
    !isset($_POST['my_doctors_nonce']) ||
    !wp_verify_nonce($_POST['my_doctors_nonce'], 'my_doctors_save_meta')
  ) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }


  if (isset($_POST['experience'])) {
    $data = absint($_POST['experience']);
    $data = max(0, $data); // Проверка ввода
    update_post_meta($post_id, 'experience', absint($_POST['experience']));
  }

  if (isset($_POST['price_from'])) {
    $data = absint($_POST['price_from']);
    $data = max(0, $data); // Проверка ввода
    update_post_meta($post_id, 'price_from', absint($_POST['price_from']));
  }

  if (isset($_POST['rating'])) {
    $data = floatval($_POST['rating']);
    $data = min(5, max(0, $data)); // Проверка ввода
    update_post_meta($post_id, 'rating', $data);
  }
}
add_action('save_post_doctors', 'my_doctors_save_meta');