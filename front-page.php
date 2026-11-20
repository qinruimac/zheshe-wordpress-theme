<?php
/**
 * 站点首页。「设置 → 阅读」选「最新文章」时与 index.php 相同；
 * 选「静态页面」时主循环是该页面：先输出页面正文（有内容时），再输出文章列表。
 *
 * @package Zheshe
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<main id="main-content">

<?php get_template_part('template-parts/hero'); ?>

<div class="row" id="latest-posts">
  <div class="col-lg-8">
    <?php if (is_page()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <?php if ('' !== trim(get_the_content())) : ?>
          <div class="single-post-content mb-4">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
            </article>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>

    <?php get_template_part('template-parts/post-list'); ?>
  </div>

  <?php get_sidebar(); ?>
</div>

</main>

<?php get_footer(); ?>
