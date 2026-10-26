<?php
/**
 * 搜索表单模板
 * 主题统一使用 Bootstrap 风格的搜索框（此前 404 / 搜索页调用的是 WP 原生表单，
 * 与侧边栏样式不一致）
 *
 * @package Zheshe
 */
if (!defined('ABSPATH')) exit;
?>
<form role="search" method="get" class="search-form blog-search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <label class="visually-hidden" for="zheshe-search-field"><?php echo esc_attr_x('Search for:', 'label', 'zheshe'); ?></label>
  <div class="input-group">
    <input type="search" id="zheshe-search-field" class="form-control search-field"
           placeholder="<?php echo esc_attr_x('Search posts...', 'placeholder', 'zheshe'); ?>"
           value="<?php echo get_search_query(); ?>" name="s">
    <button class="btn btn-primary search-submit" type="submit">
      <i class="bi bi-search me-1"></i><?php echo esc_attr_x('Search', 'submit button', 'zheshe'); ?>
    </button>
  </div>
</form>
