<?php
/**
 * 首页 Hero 区
 * 抽取自 index.php / front-page.php，文案与风格由 Customizer 控制
 *
 * @package Zheshe
 */
if (!defined('ABSPATH')) exit;

$hero_style = zheshe_hero_mod('style', 'gradient');
$hero_class = ('dark' === $hero_style) ? 'blog-hero blog-hero-dark' : 'blog-hero';
?>
<div class="<?php echo esc_attr($hero_class); ?>">
  <div class="row align-items-center">
    <div class="col-lg-8">
      <h1><?php echo esc_html(zheshe_hero_mod('title', __('Share knowledge, record life', 'zheshe'))); ?></h1>
      <p class="lead"><?php echo esc_html(zheshe_hero_mod('subtitle', __('Explore technology, life and travel, find resonance here.', 'zheshe'))); ?></p>
      <a href="#latest-posts" class="btn btn-light"><?php _e('Start Reading', 'zheshe'); ?> <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="col-lg-4 d-none d-lg-block text-center">
      <i class="bi bi-journal-text" style="font-size: 5rem;"></i>
    </div>
  </div>
</div>
