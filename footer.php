<?php
if (!defined('ABSPATH')) exit;
?>
  <footer class="footer-area mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold mb-2"><?php echo esc_html(get_bloginfo('name')); ?></h6>
          <p class="small"><?php echo esc_html(get_bloginfo('description')); ?></p>
        </div>
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold mb-2"><?php esc_html_e('Quick Links', 'zheshe'); ?></h6>
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
            echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'zheshe') . '</a></li>';
            $pages = get_pages(array('number' => 5));
            foreach ($pages as $page) {
              echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
            }
            echo '</ul>';
          }
          ?>
        </div>
        <?php if (zheshe_has_subscription_plugin()) : ?>
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold mb-2"><?php esc_html_e('Subscribe Updates', 'zheshe'); ?></h6>
          <p class="small opacity-75"><?php esc_html_e('Get notified of new posts', 'zheshe'); ?></p>
          <?php if (zheshe_has_subscription_plugin() === 'jetpack') : ?>
            <?php echo do_shortcode('[jetpack_subscription_form]'); ?>
          <?php elseif (zheshe_has_subscription_plugin() === 'mailchimp') : ?>
            <?php mc4wp_show_form(); ?>
          <?php endif; ?>
        </div>
        <?php else : ?>
        <div class="col-md-4 mb-3">
          <h6 class="fw-bold mb-2"><?php esc_html_e('Follow Us', 'zheshe'); ?></h6>
          <p class="small opacity-75"><?php esc_html_e('Subscribe via RSS', 'zheshe'); ?></p>
          <a href="<?php echo esc_url(get_feed_link()); ?>" class="btn btn-warning btn-sm text-dark fw-bold">
            <i class="bi bi-rss-fill me-1"></i><?php esc_html_e('RSS Feed', 'zheshe'); ?>
          </a>
        </div>
        <?php endif; ?>
        <?php
        // 输出后台「外观 → 小工具 → 底部区域」里添加的自定义组件
        if (is_active_sidebar('footer-1')) {
          dynamic_sidebar('footer-1');
        }
        ?>
      </div>
      <hr class="opacity-25">
      <div class="text-center small">
        <?php
        // 署名链接取自主题 Author URI，并可通过 filter 移除；模板不硬编码 URL。
        $zheshe_credit_url = zheshe_credit_url();
        ?>
        <p>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?> · <?php esc_html_e('Powered by WordPress', 'zheshe'); ?><?php if (zheshe_show_credit()) : ?> · <?php esc_html_e('Theme Designed by', 'zheshe'); ?> <?php if ($zheshe_credit_url) : ?><a href="<?php echo esc_url($zheshe_credit_url); ?>" class="text-white">eRui.org</a><?php else : ?><span class="text-white">eRui.org</span><?php endif; ?><?php endif; ?></p>
      </div>
    </div>
  </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>