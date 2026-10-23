<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<div class="single-post-header">
  <?php if (is_category()) : ?>
    <h1><i class="bi bi-folder me-2"></i><?php _e('Category:', 'prism'); ?> <?php single_cat_title(); ?></h1>
  <?php elseif (is_tag()) : ?>
    <h1><i class="bi bi-hash me-2"></i><?php _e('Tag:', 'prism'); ?> <?php single_tag_title(); ?></h1>
  <?php elseif (is_author()) : ?>
    <h1><i class="bi bi-person me-2"></i><?php _e('Author:', 'prism'); ?> <?php the_author(); ?></h1>
  <?php elseif (is_day()) : ?>
    <h1><i class="bi bi-calendar me-2"></i><?php _e('Daily Archive:', 'prism'); ?> <?php echo get_the_date(); ?></h1>
  <?php elseif (is_month()) : ?>
    <h1><i class="bi bi-calendar me-2"></i><?php _e('Monthly Archive:', 'prism'); ?> <?php echo get_the_date('F Y'); ?></h1>
  <?php elseif (is_year()) : ?>
    <h1><i class="bi bi-calendar me-2"></i><?php _e('Yearly Archive:', 'prism'); ?> <?php echo get_the_date('Y'); ?></h1>
  <?php else : ?>
    <h1><i class="bi bi-archive me-2"></i><?php _e('Archive', 'prism'); ?></h1>
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
            <div class="post-card card h-100">
              <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium', array('class' => 'card-img-top')); ?>
                </a>
              <?php endif; ?>
              <div class="card-body">
                <?php echo prism_post_categories(); ?>
                <h6 class="card-title">
                  <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark"><?php the_title(); ?></a>
                </h6>
                <p class="card-text small text-muted"><?php echo esc_html(get_the_excerpt()); ?></p>
                <small class="text-muted">
                  <?php echo get_the_date(); ?> · <i class="bi bi-eye"></i> <?php echo esc_html(prism_post_views()); ?>
                </small>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

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
        <i class="bi bi-inbox text-muted" style="font-size:3rem;"></i>
        <h4 class="mt-3 text-muted"><?php _e('No posts yet', 'prism'); ?></h4>
      </div>
    <?php endif; ?>
  </div>

  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>