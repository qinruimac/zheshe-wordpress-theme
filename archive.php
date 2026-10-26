<?php
if (!defined('ABSPATH')) exit;
get_header();
?>
<main id="main-content">

<div class="single-post-header">
  <?php if (is_category()) : ?>
    <h1><i class="bi bi-folder me-2"></i><?php _e('Category:', 'zheshe'); ?> <?php single_cat_title(); ?></h1>
  <?php elseif (is_tag()) : ?>
    <h1><i class="bi bi-hash me-2"></i><?php _e('Tag:', 'zheshe'); ?> <?php single_tag_title(); ?></h1>
  <?php elseif (is_author()) : ?>
    <h1><i class="bi bi-person me-2"></i><?php _e('Author:', 'zheshe'); ?> <?php the_author(); ?></h1>
  <?php elseif (is_day()) : ?>
    <h1><i class="bi bi-calendar me-2"></i><?php _e('Daily Archive:', 'zheshe'); ?> <?php echo get_the_date(); ?></h1>
  <?php elseif (is_month()) : ?>
    <h1><i class="bi bi-calendar me-2"></i><?php _e('Monthly Archive:', 'zheshe'); ?> <?php echo get_the_date('F Y'); ?></h1>
  <?php elseif (is_year()) : ?>
    <h1><i class="bi bi-calendar me-2"></i><?php _e('Yearly Archive:', 'zheshe'); ?> <?php echo get_the_date('Y'); ?></h1>
  <?php else : ?>
    <h1><i class="bi bi-archive me-2"></i><?php _e('Archive', 'zheshe'); ?></h1>
  <?php endif; ?>
  <?php if (is_category() && category_description()) : ?>
    <p class="lead mt-2"><?php echo category_description(); ?></p>
  <?php endif; ?>
</div>

<div class="row">
  <div class="col-lg-8">
    <?php if (have_posts()) : ?>
      <div class="row g-3">
        <?php while (have_posts()) : the_post(); ?>
          <div class="col-md-6">
            <?php get_template_part('template-parts/content-card'); ?>
          </div>
        <?php endwhile; ?>
      </div>

      <?php zheshe_pagination(); ?>
    <?php else : ?>
      <div class="text-center py-5">
        <i class="bi bi-inbox text-muted" style="font-size:3rem;"></i>
        <h4 class="mt-3 text-muted"><?php _e('No posts yet', 'zheshe'); ?></h4>
      </div>
    <?php endif; ?>
  </div>

  <?php get_sidebar(); ?>
</div>

</main>

<?php get_footer(); ?>