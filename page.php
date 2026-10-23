<?php
if (!defined('ABSPATH')) exit;
get_header();

while (have_posts()) : the_post();
?>

<!-- 页面头部 -->
<div class="single-post-header">
  <h1><?php the_title(); ?></h1>
  <small class="opacity-75"><?php echo get_the_date(); ?></small>
</div>

<div class="row">
  <!-- 页面内容 -->
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

      <?php if (comments_open() || get_comments_number()) : ?>
        <div class="mt-4">
          <?php comments_template(); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- 侧边栏 -->
  <?php get_sidebar(); ?>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>