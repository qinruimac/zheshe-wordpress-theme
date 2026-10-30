<?php
if (!defined('ABSPATH')) exit;
?>
<div class="col-lg-4">
  <div class="sidebar-card card">
    <div class="card-body">
      <form role="search" method="get" class="blog-search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="input-group">
          <input type="search" class="form-control" placeholder="<?php esc_attr_e('Search posts...', 'zheshe'); ?>" value="<?php echo get_search_query(); ?>" name="s">
          <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        </div>
      </form>
    </div>
  </div>

  <?php
  // 输出后台「外观 → 小工具 → 博客侧边栏」里添加的自定义组件（如「按钮链接」）
  if (is_active_sidebar('sidebar-1')) {
    dynamic_sidebar('sidebar-1');
  }
  ?>

  <div class="sidebar-card card">
    <div class="card-body">
      <h5 class="mb-3"><?php _e('Categories', 'zheshe'); ?></h5>
      <div class="list-group list-group-flush">
        <?php
        $categories = get_categories(array('number' => 10));
        foreach ($categories as $cat) :
          $icon = zheshe_category_icon($cat->term_id);
        ?>
          <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="list-group-item list-group-item-action d-flex justify-content-between">
            <span><i class="bi <?php echo esc_attr($icon); ?> me-2"></i><?php echo esc_html($cat->name); ?></span>
            <span class="badge bg-primary rounded-pill"><?php echo esc_html($cat->count); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="sidebar-card card">
    <div class="card-body">
      <h5 class="mb-3"><?php _e('Popular Tags', 'zheshe'); ?></h5>
      <?php
      $tags = get_tags(array('number' => 15, 'orderby' => 'count', 'order' => 'DESC'));
      foreach ($tags as $tag) :
      ?>
        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge bg-light text-dark tag-badge">
          <?php echo esc_html($tag->name); ?>
        </a>
      <?php endforeach; ?>
      <?php if (empty($tags)) : ?>
        <p class="text-muted small mb-0"><?php _e('No tags yet', 'zheshe'); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="sidebar-card card">
    <div class="card-body">
      <h5 class="mb-3"><?php _e('Popular Posts', 'zheshe'); ?></h5>
      <?php
      $popular = new WP_Query(array(
        'posts_per_page' => 3,
        'meta_key' => 'zheshe_post_views',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
      ));
      // 在循环开始前缓存判断结果：循环结束后 have_posts() 必为 false
      $has_popular = $popular->have_posts();
      while ($popular->have_posts()) : $popular->the_post();
      ?>
        <div class="d-flex gap-2 mb-3">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail(array(60, 60), array('class' => 'rounded flex-shrink-0')); ?>
          <?php endif; ?>
          <div>
            <a href="<?php the_permalink(); ?>" class="text-decoration-none small fw-bold"><?php the_title(); ?></a>
            <br>
            <small class="text-muted"><?php _e('Views', 'zheshe'); ?> <?php echo esc_html(zheshe_post_views()); ?></small>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
      <?php if (!$has_popular) : ?>
        <p class="text-muted small mb-0"><?php _e('No posts yet', 'zheshe'); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <?php echo zheshe_subscription_form(); ?>
</div>