<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<div class="single-post-header">
  <h1><i class="bi bi-search me-2"></i><?php _e('Search Results', 'prism'); ?></h1>
  <p class="lead mt-2"><?php _e('Keyword:', 'prism'); ?> "<?php echo esc_html(get_search_query()); ?>"</p>
</div>

<div class="row">
  <div class="col-lg-8">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <div class="search-result-card">
          <div class="d-flex align-items-start gap-3">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail(array(100, 100), array('class' => 'rounded')); ?>
            <?php endif; ?>
            <div class="flex-grow-1">
              <?php echo prism_post_categories(); ?>
              <h5 class="mb-1">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark"><?php the_title(); ?></a>
              </h5>
              <p class="small text-muted mb-1"><?php echo esc_html(get_the_excerpt()); ?></p>
              <small class="text-muted">
                <?php echo get_the_date(); ?> · <i class="bi bi-eye"></i> <?php echo esc_html(prism_post_views()); ?>
              </small>
            </div>
          </div>
        </div>
      <?php endwhile; ?>

      <nav class="mt-4">
        <?php
        echo paginate_links(array(
          'type' => 'list',
          'prev_text' => '«',
          'next_text' => '»',
        ));
        ?>
      </nav>
    <?php else : ?>
      <div class="text-center py-5">
        <i class="bi bi-emoji-frown text-muted" style="font-size:3rem;"></i>
        <h4 class="mt-3 text-muted"><?php _e('No posts found', 'prism'); ?></h4>
        <p class="text-muted"><?php _e('Try a different keyword!', 'prism'); ?></p>
        <div class="mt-3">
          <?php get_search_form(); ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>