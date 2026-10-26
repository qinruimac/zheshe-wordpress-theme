<?php
if (!defined('ABSPATH')) exit;
get_header();
?>
<main id="main-content">

<?php get_template_part('template-parts/hero'); ?>

<div class="row" id="latest-posts">
  <!-- 文章列表 -->
  <div class="col-lg-8">
    <h3 class="mb-3"><i class="bi bi-fire text-danger me-2"></i><?php _e('Latest Posts', 'prism'); ?></h3>

    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $home_query = new WP_Query(array(
      'posts_per_page' => 7,
      'paged' => $paged,
    ));
    ?>

    <?php if ($home_query->have_posts()) : ?>

      <!-- 特色文章（第一篇） -->
      <?php if ($paged === 1) : ?>
        <?php while ($home_query->have_posts()) : $home_query->the_post(); ?>
          <?php if ($home_query->current_post === 0) : ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('featured-post card mb-4'); ?>>
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('prism-featured', array('class' => 'card-img-top')); ?>
              <?php endif; ?>
              <div class="card-body">
                <?php echo prism_post_categories(); ?>
                <h3><a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark"><?php the_title(); ?></a></h3>
                <p class="text-muted"><?php echo esc_html(get_the_excerpt()); ?></p>
                <div class="d-flex align-items-center">
                  <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'rounded-circle me-2')); ?>
                  <small class="text-muted">
                    <?php the_author(); ?> · <?php echo get_the_date(); ?>
                    · <i class="bi bi-eye"></i> <?php echo esc_html(prism_post_views()); ?>
                    · <i class="bi bi-chat"></i> <?php echo esc_html(get_comments_number()); ?>
                  </small>
                </div>
              </div>
            </article>
            <?php break; ?>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>

      <!-- 文章网格 -->
      <div class="row g-3">
        <?php
        // 注意：特色文章循环已经消费了第一篇文章，主查询指针已前进，
        // 这里无需再跳过一次（否则会漏掉第二篇文章）
        while ($home_query->have_posts()) : $home_query->the_post(); ?>
          <div class="col-md-6">
            <?php get_template_part('template-parts/content-card'); ?>
          </div>
        <?php endwhile; ?>
      </div>

      <?php prism_pagination(array(
        'total' => $home_query->max_num_pages,
        'current' => max(1, $paged),
      )); ?>

    <?php else : ?>
      <div class="text-center py-5">
        <i class="bi bi-inbox text-muted" style="font-size:3rem;"></i>
        <h4 class="mt-3 text-muted"><?php _e('No posts yet', 'prism'); ?></h4>
        <p class="text-muted"><?php _e('Start writing and share your story!', 'prism'); ?></p>
      </div>
    <?php endif; wp_reset_postdata(); ?>
  </div>

  <!-- 侧边栏 -->
  <?php get_sidebar(); ?>
</div>

</main>

<?php get_footer(); ?>