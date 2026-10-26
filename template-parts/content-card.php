<?php
/**
 * 文章卡片（列表/网格通用）
 * 抽取自 index.php / front-page.php / archive.php，此前三份 HTML 各自为政，
 * 修改一处容易漏掉另外两处。
 *
 * @package Prism
 */
if (!defined('ABSPATH')) exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-card card h-100'); ?>>
  <?php if (has_post_thumbnail()) : ?>
    <a href="<?php the_permalink(); ?>" class="post-card-thumb">
      <?php the_post_thumbnail('prism-card', array('class' => 'card-img-top')); ?>
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
</article>
