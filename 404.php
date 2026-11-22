<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<main id="main-content">
<div class="error-404">
  <div class="single-post-header mb-4">
    <h1>404</h1>
    <p class="lead"><?php esc_html_e('Page Not Found', 'zheshe'); ?></p>
  </div>
  <p class="text-muted mb-4"><?php esc_html_e('The page you are looking for does not exist or has been removed.', 'zheshe'); ?></p>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <?php get_search_form(); ?>
    </div>
  </div>
  <div class="mt-4">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
      <i class="bi bi-house me-1"></i><?php esc_html_e('Back to Home', 'zheshe'); ?>
    </a>
  </div>
</div>
</main>

<?php get_footer(); ?>