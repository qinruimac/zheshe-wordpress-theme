<?php
/**
 * 博客侧边栏：完全由「外观 → 小工具 → 博客侧边栏」驱动。
 * 主题不会自动写入小工具；全新站点可在 Customizer 中通过 starter content
 * 一键采用默认布局（搜索/分类/标签/热门文章/订阅），之后可自由增删排序——
 * 包括官方小工具与主题的「按钮链接」小工具。
 *
 * @package Zheshe
 */
if (!defined('ABSPATH')) exit;
?>
<div class="col-lg-4">
  <?php
  if (is_active_sidebar('sidebar-1')) {
    dynamic_sidebar('sidebar-1');
  }
  ?>
</div>
