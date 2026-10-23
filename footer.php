<?php
if (!defined('ABSPATH')) exit;
?>
  <footer class="footer-area mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold mb-2"><?php bloginfo('name'); ?></h6>
          <p class="small"><?php bloginfo('description'); ?></p>
        </div>
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold mb-2"><?php _e('Quick Links', 'prism'); ?></h6>
          <?php
          if (has_nav_menu('footer')) {
            wp_nav_menu(array(
              'theme_location' => 'footer',
              'container' => false,
              'menu_class' => 'list-unstyled small',
              'depth' => 1,
            ));
          } else {
            echo '<ul class="list-unstyled small">';
            echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'prism') . '</a></li>';
            $pages = get_pages(array('number' => 5));
            foreach ($pages as $page) {
              echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
            }
            echo '</ul>';
          }
          ?>
        </div>
        <?php if (prism_has_subscription_plugin()) : ?>
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold mb-2"><?php _e('Subscribe Updates', 'prism'); ?></h6>
          <p class="small opacity-75"><?php _e('Get notified of new posts', 'prism'); ?></p>
          <?php if (prism_has_subscription_plugin() === 'jetpack') : ?>
            <?php echo do_shortcode('[jetpack_subscription_form]'); ?>
          <?php elseif (prism_has_subscription_plugin() === 'mailchimp') : ?>
            <?php mc4wp_show_form(); ?>
          <?php endif; ?>
        </div>
        <?php else : ?>
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold mb-2"><?php _e('Follow Us', 'prism'); ?></h6>
          <p class="small opacity-75"><?php _e('Subscribe via RSS', 'prism'); ?></p>
          <a href="<?php echo esc_url(get_feed_link()); ?>" class="btn btn-warning btn-sm text-dark fw-bold">
            <i class="bi bi-rss-fill me-1"></i><?php _e('RSS Feed', 'prism'); ?>
          </a>
        </div>
        <?php endif; ?>
      </div>
      <hr class="opacity-25">
      <div class="text-center small">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> · Powered by WordPress · Theme Designed by <a href="https://eRui.org" class="text-white">eRui.org</a></p>
      </div>
    </div>
  </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>