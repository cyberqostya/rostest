<?php
get_header();
?>

<main class="doctors-archive">

  <h1>Наши доктора</h1>

  <!-- Фильтр -->
  <form method="get" class="doctors-filters" action="<?php echo esc_url(get_post_type_archive_link('doctors')); ?>">

    <!-- Специализация -->
    <label for="specialization">Специализация:</label>
    <select name="specialization" id="specialization">
      <option value="">Все</option>
      <?php
      $terms = get_terms(array(
        'taxonomy' => 'specialization',
        'hide_empty' => false,
      ));
      $current = isset($_GET['specialization']) ? sanitize_text_field($_GET['specialization']) : '';
      foreach ($terms as $term):
        $selected = $current === $term->slug ? 'selected' : '';
        echo "<option value='{$term->slug}' {$selected}>{$term->name}</option>";
      endforeach;
      ?>
    </select>

    <!-- Город -->
    <label for="city">Город:</label>
    <select name="city" id="city">
      <option value="">Все</option>
      <?php
      $terms = get_terms(array(
        'taxonomy' => 'city',
        'hide_empty' => false,
      ));
      $current = isset($_GET['city']) ? sanitize_text_field($_GET['city']) : '';
      foreach ($terms as $term):
        $selected = $current === $term->slug ? 'selected' : '';
        echo "<option value='{$term->slug}' {$selected}>{$term->name}</option>";
      endforeach;
      ?>
    </select>

    <!-- Сортировка -->
    <label for="sort">Сортировать:</label>
    <select name="sort" id="sort">
      <option value="">Без сортировки</option>
      <option value="rating_desc" <?php selected($_GET['sort'] ?? '', 'rating_desc'); ?>>По рейтингу ↓</option>
      <option value="price_asc" <?php selected($_GET['sort'] ?? '', 'price_asc'); ?>>По цене ↑</option>
      <option value="experience_desc" <?php selected($_GET['sort'] ?? '', 'experience_desc'); ?>>По стажу ↓</option>
    </select>

    <button type="submit">Применить</button>
  </form>


  <?php if (have_posts()): ?>
    <div class="doctors-list">

      <?php
      while (have_posts()):
        the_post();
        ?>

        <a href="<?php the_permalink(); ?>" class="doctor-card">

          <?php if (has_post_thumbnail()): ?>
            <div class="doctor-card__thumb">
              <?php the_post_thumbnail('medium'); ?>
            </div>
          <?php endif; ?>

          <p class="doctor-card__name">
            <?php the_title(); ?>
          </p>

          <?php
          $specializations = get_the_terms(get_the_ID(), 'specialization');
          if (!empty($specializations) && !is_wp_error($specializations)):
            $spec_names = wp_list_pluck($specializations, 'name');
            ?>
            <div class="doctor-card__specialization">
              <span class="doctor-card__specialization-title">Специализация:</span>
              <span
                class="doctor-card__specialization-text"><?php echo esc_html(implode(', ', array_slice($spec_names, 0, 2))); // ТЗ: специализация (1–2 значения) ?></span>
            </div>
          <?php endif; ?>

          <?php
          $experience = get_post_meta(get_the_ID(), 'experience', true);
          $price_from = get_post_meta(get_the_ID(), 'price_from', true);
          $rating = get_post_meta(get_the_ID(), 'rating', true);
          ?>

          <ul class="doctor-card__meta">
            <?php if ($experience): ?>
              <li>Стаж: <?php echo esc_html($experience); ?> лет</li>
            <?php endif; ?>

            <?php if ($price_from): ?>
              <li>Цена от: <?php echo esc_html($price_from); ?> ₽</li>
            <?php endif; ?>

            <?php if ($rating): ?>
              <li>Рейтинг: <?php echo esc_html($rating); ?>/5</li>
            <?php endif; ?>
          </ul>

        </a>

      <?php endwhile; ?>

    </div>

    <div class="doctors-pagination">
      <?php
      echo paginate_links(array(
        'prev_text' => '« Назад',
        'next_text' => 'Вперёд »',
      ));
      ?>
    </div>

  <?php else: ?>
    <p>Доктора не найдены.</p>
  <?php endif; ?>

</main>

<?php
get_footer();
