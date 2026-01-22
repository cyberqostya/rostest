<?php
get_header();
?>

<main class="doctor-single">
  <?php
  if (have_posts()):
    while (have_posts()):
      the_post();
      ?>

      <a href="/doctors">Назад</a>

      <article id="post-<?php the_ID(); ?>">
        <h1 class="doctor__title">
          <?php the_title(); ?>
        </h1>

        <?php if (has_post_thumbnail()): ?>
          <div class="doctor__thumbnail">
            <?php the_post_thumbnail('large'); ?>
          </div>
        <?php endif; ?>

        <?php if (has_excerpt()): ?>
          <div class="doctor__excerpt">
            <?php echo esc_html(get_the_excerpt()); ?>
          </div>
        <?php endif; ?>

        <?php
        $experience = get_post_meta(get_the_ID(), 'experience', true);
        $price_from = get_post_meta(get_the_ID(), 'price_from', true);
        $rating = get_post_meta(get_the_ID(), 'rating', true);
        ?>

        <ul class="doctor__meta">
          <?php if ($experience): ?>
            <li><strong>Стаж:</strong>
              <?php echo esc_html($experience); ?> лет
            </li>
          <?php endif; ?>

          <?php if ($price_from): ?>
            <li><strong>Цена от:</strong>
              <?php echo esc_html($price_from); ?> ₽
            </li>
          <?php endif; ?>

          <?php if ($rating): ?>
            <li><strong>Рейтинг:</strong>
              <?php echo esc_html($rating); ?>/5
            </li>
          <?php endif; ?>
        </ul>

        <div class="doctor__taxonomies">

          <?php
          $specializations = get_the_terms(get_the_ID(), 'specialization');
          if (!empty($specializations) && !is_wp_error($specializations)):
            ?>
            <p class="doctor__taxonomy">
              <strong>Специализация:</strong>
              <?php
              $spec_names = wp_list_pluck($specializations, 'name');
              echo esc_html(implode(', ', $spec_names));
              ?>
            </p>
          <?php endif; ?>

          <?php
          $cities = get_the_terms(get_the_ID(), 'city');
          if (!empty($cities) && !is_wp_error($cities)):
            ?>
            <p class="doctor__taxonomy">
              <strong>Город:</strong>
              <?php
              $city_names = wp_list_pluck($cities, 'name');
              echo esc_html(implode(', ', $city_names));
              ?>
            </p>
          <?php endif; ?>

        </div>

        <div class="doctor__content">
          <?php the_content(); ?>
        </div>

      </article>

      <?php
    endwhile;
  endif;
  ?>
</main>

<?php
get_footer();
