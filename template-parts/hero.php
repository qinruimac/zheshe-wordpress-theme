<?php
/**
 * 首页 Hero 区
 * 抽取自 index.php / front-page.php，文案与风格由 Customizer 控制
 *
 * @package Prism
 */
if (!defined('ABSPATH')) exit;

$hero_style = get_theme_mod('blog_hero_style', 'gradient');
$hero_class = ('dark' === $hero_style) ? 'blog-hero blog-hero-dark' : 'blog-hero';
?>
<div class="<?php echo esc_attr($hero_class); ?>">
  <div class="row align-items-center">
    <div class="col-lg-8">
      <h1><?php echo esc_html(get_theme_mod('blog_hero_title', __('Share knowledge, record life', 'prism'))); ?></h1>
      <p class="lead"><?php echo esc_html(get_theme_mod('blog_hero_subtitle', __('Explore technology, life and travel, find resonance here.', 'prism'))); ?></p>
      <a href="#latest-posts" class="btn btn-light"><?php _e('Start Reading', 'prism'); ?> <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="col-lg-4 d-none d-lg-block text-center">
      <i class="bi bi-journal-text" style="font-size: 5rem;"></i>
    </div>
  </div>
</div>
