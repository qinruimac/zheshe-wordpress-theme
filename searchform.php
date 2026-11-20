<?php
/**
 * 搜索表单模板
 * 主题统一使用 Bootstrap 风格的搜索框（此前 404 / 搜索页调用的是 WP 原生表单，
 * 与侧边栏样式不一致）
 *
 * 侧边栏「Zheshe: Search」小工具传入 zheshe_compact => true：按钮只显示图标，
 * 且不带 search-form / search-field / search-submit 类（那组样式是给官方搜索小工具用的）。
 *
 * @package Zheshe
 */
if (!defined('ABSPATH')) exit;

$zheshe_compact  = !empty($args['zheshe_compact']);
$zheshe_field_id = wp_unique_id('zheshe-search-field-');
?>
<form role="search" method="get" class="<?php echo $zheshe_compact ? 'blog-search-form' : 'search-form blog-search-form'; ?>" action="<?php echo esc_url(home_url('/')); ?>">
  <label class="visually-hidden" for="<?php echo esc_attr($zheshe_field_id); ?>"><?php echo esc_html_x('Search for:', 'label', 'zheshe'); ?></label>
  <div class="input-group">
    <input type="search" id="<?php echo esc_attr($zheshe_field_id); ?>" class="<?php echo $zheshe_compact ? 'form-control' : 'form-control search-field'; ?>"
           placeholder="<?php echo esc_attr_x('Search posts...', 'placeholder', 'zheshe'); ?>"
           value="<?php echo get_search_query(); ?>" name="s">
    <?php if ($zheshe_compact) : ?>
      <button class="btn btn-primary" type="submit">
        <i class="bi bi-search" aria-hidden="true"></i><span class="visually-hidden"><?php echo esc_html_x('Search', 'submit button', 'zheshe'); ?></span>
      </button>
    <?php else : ?>
      <button class="btn btn-primary search-submit" type="submit">
        <i class="bi bi-search me-1"></i><?php echo esc_html_x('Search', 'submit button', 'zheshe'); ?>
      </button>
    <?php endif; ?>
  </div>
</form>
