<?php
if (!defined('ABSPATH')) exit;
get_header();

while (have_posts()) : the_post();
?>

<div class="single-post-header">
  <div class="row">
    <div class="col-lg-10">
      <?php echo prism_post_categories(); ?>
      <h1><?php the_title(); ?></h1>
      <div class="d-flex align-items-center mt-3">
        <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'rounded-circle me-2')); ?>
        <div>
          <div class="fw-bold"><?php the_author(); ?></div>
          <small class="opacity-75">
            <?php echo get_the_date(); ?> · <i class="bi bi-eye"></i> <?php echo esc_html(prism_post_views()); ?>
            · <i class="bi bi-clock"></i> <?php echo esc_html(prism_reading_time()); ?> <?php _e('min read', 'prism'); ?>
          </small>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="single-post-content">
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('large', array('class' => 'mb-4')); ?>
      <?php endif; ?>

      <div class="entry-content">
        <?php the_content(); ?>
      </div>

      <?php wp_link_pages(array(
        'before' => '<nav class="mt-4"><ul class="pagination justify-content-center">',
        'after' => '</ul></nav>',
        'type' => 'list',
      )); ?>

      <?php $tags = get_the_tags(); ?>
      <?php if ($tags) : ?>
        <div class="mt-4">
          <h6 class="mb-2"><?php _e('Tags', 'prism'); ?></h6>
          <?php foreach ($tags as $tag) : ?>
            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge bg-light text-dark tag-badge">
              <?php echo esc_html($tag->name); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="card border-0 shadow-sm mt-4">
        <div class="card-body d-flex align-items-center">
          <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', array('class' => 'rounded-circle me-3')); ?>
          <div>
            <h6 class="mb-1"><?php the_author(); ?></h6>
            <p class="small text-muted mb-0"><?php echo esc_html(get_the_author_meta('description')); ?></p>
          </div>
        </div>
      </div>

      <div class="row mt-4 g-3">
        <div class="col-6">
          <?php $prev = get_previous_post(); ?>
          <?php if ($prev) : ?>
            <a href="<?php echo esc_url(get_permalink($prev->ID)); ?>" class="text-decoration-none">
              <div class="card border-0 shadow-sm p-3">
                <small class="text-muted"><i class="bi bi-arrow-left me-1"></i><?php _e('Previous', 'prism'); ?></small>
                <div class="fw-bold small"><?php echo esc_html($prev->post_title); ?></div>
              </div>
            </a>
          <?php endif; ?>
        </div>
        <div class="col-6">
          <?php $next = get_next_post(); ?>
          <?php if ($next) : ?>
            <a href="<?php echo esc_url(get_permalink($next->ID)); ?>" class="text-decoration-none">
              <div class="card border-0 shadow-sm p-3 text-end">
                <small class="text-muted"><?php _e('Next', 'prism'); ?><i class="bi bi-arrow-right ms-1"></i></small>
                <div class="fw-bold small"><?php echo esc_html($next->post_title); ?></div>
              </div>
            </a>
          <?php endif; ?>
        </div>
      </div>

      <?php if (comments_open() || get_comments_number()) : ?>
        <div class="mt-4">
          <?php comments_template(); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php get_sidebar(); ?>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>