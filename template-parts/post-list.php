<?php
/**
 * 文章列表：第一页的第一篇为特色大卡片，其余为双列网格，末尾分页。
 * 抽取自 index.php / front-page.php，两者共用。
 *
 * - 博客首页 / 文章页：直接使用主循环。每页数量跟随「设置 → 阅读」，
 *   置顶文章由 Core 排到最前，并通过 post_class() 自动带 .sticky 类。
 * - 静态首页：主循环是页面本身（由 front-page.php 输出），这里再查一次文章列表；
 *   同样不指定 posts_per_page，仍跟随「设置 → 阅读」。
 *
 * @package Zheshe
 */
if (!defined('ABSPATH')) exit;

if (is_front_page() && !is_home()) {
    // 静态首页上 Core 会把 /page/N/ 的 paged 转成 page
    $zheshe_paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
    // 必须显式写 post_type：只带 paged 的查询会被 Core 当成「静态首页」请求，查回首页页面本身
    $zheshe_list  = new WP_Query(array(
        'post_type' => 'post',
        'paged'     => $zheshe_paged,
    ));
    if (1 === $zheshe_paged) {
        add_filter('post_class', 'zheshe_front_list_sticky_class', 10, 3);
    }
} else {
    $zheshe_paged = max(1, (int) get_query_var('paged'));
    $zheshe_list  = $GLOBALS['wp_query'];
}
?>
<h3 class="mb-3"><i class="bi bi-fire text-danger me-2"></i><?php esc_html_e('Latest Posts', 'zheshe'); ?></h3>

<?php if ($zheshe_list->have_posts()) : ?>

  <?php if (1 === $zheshe_paged) : ?>
    <?php while ($zheshe_list->have_posts()) : $zheshe_list->the_post(); ?>
      <?php if (0 === $zheshe_list->current_post) : ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('featured-post card mb-4'); ?>>
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('zheshe-featured', array('class' => 'card-img-top')); ?>
        <?php endif; ?>
        <div class="card-body">
          <?php echo zheshe_post_categories(); ?>
          <h3><a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark"><?php the_title(); ?></a></h3>
          <p class="text-muted"><?php echo esc_html(get_the_excerpt()); ?></p>
          <div class="d-flex align-items-center">
            <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'rounded-circle me-2')); ?>
            <small class="text-muted">
              <?php echo esc_html(get_the_author()); ?> · <?php echo esc_html(get_the_date()); ?>
              · <i class="bi bi-eye"></i> <?php echo esc_html(zheshe_post_views()); ?>
              · <i class="bi bi-chat"></i> <?php echo esc_html(get_comments_number()); ?>
            </small>
          </div>
        </div>
      </article>
      <?php break; ?>
      <?php endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>

  <div class="row g-3">
    <?php
    // 特色文章循环已消费第一篇（查询指针已前进），此处不再额外跳过，
    // 否则首页会漏掉第二篇文章
    while ($zheshe_list->have_posts()) : $zheshe_list->the_post(); ?>
      <div class="col-md-6">
        <?php get_template_part('template-parts/content-card'); ?>
      </div>
    <?php endwhile; ?>
  </div>

  <?php zheshe_pagination(array(
    'total' => $zheshe_list->max_num_pages,
    'current' => $zheshe_paged,
  )); ?>

<?php else : ?>
  <div class="text-center py-5">
    <i class="bi bi-inbox text-muted zheshe-empty-icon"></i>
    <h4 class="mt-3 text-muted"><?php esc_html_e('No posts yet', 'zheshe'); ?></h4>
    <p class="text-muted"><?php esc_html_e('Start writing and share your story!', 'zheshe'); ?></p>
  </div>
<?php endif; ?>

<?php
if ($zheshe_list !== $GLOBALS['wp_query']) {
    remove_filter('post_class', 'zheshe_front_list_sticky_class', 10);
    wp_reset_postdata();
}
