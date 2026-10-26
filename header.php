<?php
if (!defined('ABSPATH')) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link visually-hidden-focusable" href="#main-content"><?php _e('Skip to content', 'zheshe'); ?></a>

<div class="container">
  <!-- 博客导航 -->
  <nav class="blog-nav navbar navbar-expand-lg navbar-light mb-4" role="navigation" aria-label="<?php esc_attr_e('Primary navigation', 'zheshe'); ?>">
    <button class="btn btn-light d-lg-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#blogNav">
      <i class="bi bi-list"></i>
    </button>
    <?php if (has_custom_logo()) : ?>
      <?php the_custom_logo(); ?>
    <?php else : ?>
      <a class="navbar-brand fw-bold" href="<?php echo esc_url(home_url('/')); ?>">
        <i class="bi bi-journal-richtext text-primary me-1"></i><?php echo esc_html(get_bloginfo('name')); ?>
      </a>
    <?php endif; ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blogNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="blogNav">
      <?php
      if (has_nav_menu('primary')) {
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'navbar-nav mx-auto',
          'fallback_cb' => false,
          'depth' => 2,
        ));
      } else {
        echo '<ul class="navbar-nav mx-auto">';
        echo '<li class="nav-item"><a class="nav-link active" href="' . esc_url(home_url('/')) . '">' . __('Home', 'zheshe') . '</a></li>';
        $cats = get_categories(array('number' => 4));
        foreach ($cats as $cat) {
          echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a></li>';
        }
        echo '</ul>';
      }
      ?>
      <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
        <a href="<?php echo esc_url(admin_url('post-new.php')); ?>" class="btn btn-primary btn-sm">
          <i class="bi bi-pencil-square me-1"></i><?php _e('Write', 'zheshe'); ?>
        </a>
      <?php endif; ?>
    </div>
  </nav>