<?php
if (!defined('ABSPATH')) exit;

/**
 * 内容区宽度（WordPress 规范要求，影响 oEmbed 与图片最大宽度）
 */
if (!isset($content_width)) {
    $content_width = 800;
}

function zheshe_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
        'navigation-widgets',
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('post-thumbnails');

    // 编辑器配色，与 .blog-hero / 主题主色保持一致
    add_theme_support('editor-color-palette', array(
        array('name' => __('Brand', 'zheshe'), 'slug' => 'brand', 'color' => '#667eea'),
        array('name' => __('Brand Dark', 'zheshe'), 'slug' => 'brand-dark', 'color' => '#764ba2'),
        array('name' => __('Dark', 'zheshe'), 'slug' => 'dark', 'color' => '#212529'),
        array('name' => __('Grey', 'zheshe'), 'slug' => 'grey', 'color' => '#6c757d'),
        array('name' => __('Light', 'zheshe'), 'slug' => 'light', 'color' => '#f8f9fa'),
        array('name' => __('White', 'zheshe'), 'slug' => 'white', 'color' => '#ffffff'),
    ));

    // 古腾堡编辑器样式
    add_editor_style('assets/css/editor-style.css');

    // 列表卡片：统一 16:10 裁切，避免不同比例图片导致卡片高度参差
    add_image_size('zheshe-card', 800, 500, true);
    // 特色文章大图：统一 2:1
    add_image_size('zheshe-featured', 1200, 600, true);

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'zheshe'),
        'footer' => __('Footer Menu', 'zheshe'),
    ));
}

add_action('after_setup_theme', 'zheshe_setup');

function zheshe_load_textdomain() {
    $locale = get_locale();
    $mo_file = get_template_directory() . '/languages/zheshe-' . $locale . '.mo';
    if (file_exists($mo_file)) {
        load_textdomain('zheshe', $mo_file);
    }
    load_theme_textdomain('zheshe', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'zheshe_load_textdomain', 5);

/**
 * 静态资源来源：默认使用主题内置的本地资源（assets/vendor/），
 * 这样不依赖任何外部 CDN，国内访问也能稳定加载。
 * 如需改用 CDN（例如想减少仓库体积），可在子主题中：
 *   add_filter('zheshe_use_local_assets', '__return_false');
 */
function zheshe_use_local_assets() {
    return (bool) apply_filters('zheshe_use_local_assets', true);
}

function zheshe_asset_url($vendor_path, $cdn_url) {
    if (zheshe_use_local_assets()) {
        // 本地文件缺失时自动回退到 CDN
        $local_file = get_template_directory() . '/assets/vendor/' . $vendor_path;
        if (!file_exists($local_file)) {
            return $cdn_url;
        }
        return get_template_directory_uri() . '/assets/vendor/' . $vendor_path;
    }
    return $cdn_url;
}

function zheshe_scripts() {
    $theme_uri = get_template_directory_uri();

    wp_enqueue_style(
        'bootstrap',
        zheshe_asset_url('bootstrap/css/bootstrap.min.css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'),
        array(),
        '5.3.2'
    );
    wp_enqueue_style(
        'bootstrap-icons',
        zheshe_asset_url('bootstrap-icons/bootstrap-icons.min.css', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'),
        array(),
        '1.11.1'
    );
    wp_enqueue_style('zheshe-style', get_stylesheet_uri(), array('bootstrap', 'bootstrap-icons'), '1.1.0');
    wp_enqueue_style('zheshe-custom', $theme_uri . '/assets/css/custom.css', array('zheshe-style'), '1.1.0');

    wp_enqueue_script(
        'bootstrap',
        zheshe_asset_url('bootstrap/js/bootstrap.bundle.min.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'),
        array(),
        '5.3.2',
        true
    );
    wp_enqueue_script('zheshe-main', $theme_uri . '/assets/js/main.js', array('bootstrap'), '1.1.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'zheshe_scripts');

function zheshe_widgets_init() {
    register_sidebar(array(
        'name' => __('博客侧边栏', 'zheshe'),
        'id' => 'sidebar-1',
        'description' => __('显示在博客页面右侧的侧边栏', 'zheshe'),
        'before_widget' => '<div class="sidebar-card card"><div class="card-body">',
        'after_widget' => '</div></div>',
        'before_title' => '<h5 class="mb-3">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => __('底部区域', 'zheshe'),
        'id' => 'footer-1',
        'description' => __('显示在页面底部的组件区域', 'zheshe'),
        'before_widget' => '<div class="col-md-3 mb-3">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="fw-bold mb-2">',
        'after_title' => '</h6>',
    ));
}
add_action('widgets_init', 'zheshe_widgets_init');

function zheshe_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'zheshe_excerpt_length');

function zheshe_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'zheshe_excerpt_more');

function zheshe_post_categories() {
    $categories = get_the_category();
    if (empty($categories)) return '';
    $output = '';
    foreach ($categories as $cat) {
        $color = zheshe_category_color($cat->term_id);
        $output .= '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="badge bg-' . $color . ' mb-2 me-1 text-decoration-none">' . esc_html($cat->name) . '</a>';
    }
    return $output;
}

function zheshe_category_color($cat_id) {
    $colors = array('primary', 'success', 'info', 'warning', 'danger');
    return $colors[$cat_id % count($colors)];
}

function zheshe_reading_time() {
    $content = wp_strip_all_tags(get_post_field('post_content', get_the_ID()));
    // str_word_count 对中文无效（返回 0），需要兼容中英文混排：
    // 英文按单词计，中文/日韩等按字符计
    $english_words = str_word_count(preg_replace('/[\x{4e00}-\x{9fff}\x{3040}-\x{30ff}\x{ac00}-\x{d7af}]/u', ' ', $content));
    preg_match_all('/[\x{4e00}-\x{9fff}\x{3040}-\x{30ff}\x{ac00}-\x{d7af}]/u', $content, $matches);
    $cjk_chars = count($matches[0]);
    // 英文约 200 词/分钟，中文约 400 字/分钟
    $reading_time = ceil($english_words / 200 + $cjk_chars / 400);
    return max(1, $reading_time);
}

/**
 * 读取文章浏览量（整数），并自动迁移 1.1.0 及更早版本使用的旧键 post_views
 */
function zheshe_get_views($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $views = get_post_meta($post_id, 'zheshe_post_views', true);
    if ('' === $views || false === $views) {
        $legacy = get_post_meta($post_id, 'post_views', true);
        if ('' !== $legacy && false !== $legacy) {
            update_post_meta($post_id, 'zheshe_post_views', (int) $legacy);
            delete_post_meta($post_id, 'post_views');
            return (int) $legacy;
        }
        return 0;
    }
    return (int) $views;
}

function zheshe_post_views() {
    return zheshe_format_views(zheshe_get_views(get_the_ID()));
}

function zheshe_format_views($views) {
    if ($views >= 1000) {
        return number_format($views / 1000, 1) . 'k';
    }
    return $views;
}

/**
 * 启用主题时，把 1.1.0 及更早版本遗留的 post_views 元数据批量迁移到 zheshe_post_views
 * （单篇文章的惰性迁移见 zheshe_get_views()，此处保证侧边栏「热门文章」排序立即正确）
 */
function zheshe_migrate_legacy_post_views() {
    global $wpdb;
    $rows = $wpdb->get_results(
        $wpdb->prepare("SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s", 'post_views')
    );
    if (empty($rows)) {
        return;
    }
    foreach ($rows as $row) {
        $current = get_post_meta($row->post_id, 'zheshe_post_views', true);
        if ('' === $current || false === $current) {
            update_post_meta($row->post_id, 'zheshe_post_views', (int) $row->meta_value);
        }
        delete_post_meta($row->post_id, 'post_views');
    }
}
add_action('after_switch_theme', 'zheshe_migrate_legacy_post_views');

/**
 * 兜底：直接覆盖文件升级时不会触发 after_switch_theme，
 * 因此在后台再跑一次，用 transient 标记只执行一次
 */
function zheshe_maybe_migrate_views_on_admin() {
    if (get_transient('zheshe_views_migrated')) {
        return;
    }
    zheshe_migrate_legacy_post_views();
    set_transient('zheshe_views_migrated', 1, 0);
}
add_action('admin_init', 'zheshe_maybe_migrate_views_on_admin');

/**
 * 读取 Hero 设置，并自动迁移 1.1.0 及更早版本使用的旧键 blog_hero_*
 *
 * @param string $key     title | subtitle | style
 * @param string $default 未设置时的默认值
 */
function zheshe_hero_mod($key, $default = '') {
    $new_key    = 'zheshe_hero_' . $key;
    $legacy_key = 'blog_hero_' . $key;

    $value = get_theme_mod($new_key, null);
    if (null === $value || '' === $value) {
        $legacy = get_theme_mod($legacy_key, null);
        if (null !== $legacy && '' !== $legacy) {
            set_theme_mod($new_key, $legacy);
            remove_theme_mod($legacy_key);
            return $legacy;
        }
        return $default;
    }
    return $value;
}

/**
 * 判断当前访客是否为常见爬虫/预览抓取（不计入浏览量）
 */
function zheshe_is_bot_request() {
    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower(wp_unslash($_SERVER['HTTP_USER_AGENT'])) : '';
    if ('' === $ua) {
        return false;
    }
    $patterns = array('bot', 'crawl', 'spider', 'slurp', 'preview', 'feed', 'curl', 'wget', 'python-requests', 'headlesschrome');
    foreach ($patterns as $pattern) {
        if (false !== strpos($ua, $pattern)) {
            return true;
        }
    }
    return false;
}

function zheshe_update_views() {
    // 只统计文章详情页；排除预览、自定义器iframe、Feed、以及爬虫流量
    if (!is_singular('post') || is_preview() || is_feed() || is_robots()) {
        return;
    }
    if (zheshe_is_bot_request()) {
        return;
    }
    // 同一访客短时间内重复刷新不重复计数（默认 1 小时内的同一 IP 只计一次）
    $transient_key = 'zheshe_view_' . get_the_ID() . '_' . md5(zheshe_get_visitor_ip());
    if (get_transient($transient_key)) {
        return;
    }
    set_transient($transient_key, 1, HOUR_IN_SECONDS);

    $post_id = get_the_ID();
    $views = zheshe_get_views($post_id);
    update_post_meta($post_id, 'zheshe_post_views', $views + 1);
}
// 挂在 wp（主查询就绪后）而非 wp_head，此前一进 <head> 就执行、每次刷新均 +1
add_action('wp', 'zheshe_update_views');

function zheshe_get_visitor_ip() {
    $keys = array('HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(explode(',', wp_unslash($_SERVER[$key]))[0]);
            if (false !== filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    return '0.0.0.0';
}

function zheshe_category_icon($cat_id) {
    $custom = get_term_meta($cat_id, 'zheshe_category_icon', true);
    if (!empty($custom) && array_key_exists($custom, zheshe_category_icon_choices())) {
        return $custom;
    }
    $icons = array('bi-code', 'bi-cup-hot', 'bi-airplane', 'bi-book', 'bi-music-note-beamed', 'bi-camera', 'bi-heart', 'bi-star', 'bi-lightbulb', 'bi-globe');
    return $icons[$cat_id % count($icons)];
}

function zheshe_category_icon_choices() {
    return array(
        'bi-journal-text' => __('随笔 / 博客', 'zheshe'),
        'bi-newspaper' => __('资讯 / 新闻', 'zheshe'),
        'bi-code' => __('编程开发', 'zheshe'),
        'bi-terminal' => __('命令行', 'zheshe'),
        'bi-github' => __('开源项目', 'zheshe'),
        'bi-robot' => __('人工智能', 'zheshe'),
        'bi-cpu' => __('硬件数码', 'zheshe'),
        'bi-lightbulb' => __('想法灵感', 'zheshe'),
        'bi-mortarboard' => __('学习笔记', 'zheshe'),
        'bi-book' => __('读书', 'zheshe'),
        'bi-tools' => __('教程工具', 'zheshe'),
        'bi-wrench' => __('DIY 维修', 'zheshe'),
        'bi-bug' => __('问题排查', 'zheshe'),
        'bi-cup-hot' => __('咖啡生活', 'zheshe'),
        'bi-airplane' => __('旅行游记', 'zheshe'),
        'bi-camera' => __('摄影', 'zheshe'),
        'bi-mountain' => __('户外露营', 'zheshe'),
        'bi-map' => __('地图探索', 'zheshe'),
        'bi-music-note-beamed' => __('音乐', 'zheshe'),
        'bi-film' => __('影视', 'zheshe'),
        'bi-controller' => __('游戏', 'zheshe'),
        'bi-palette' => __('设计美学', 'zheshe'),
        'bi-chat-dots' => __('闲聊杂谈', 'zheshe'),
        'bi-people' => __('团队协作', 'zheshe'),
        'bi-person' => __('个人成长', 'zheshe'),
        'bi-briefcase' => __('职场', 'zheshe'),
        'bi-graph-up' => __('数据分析', 'zheshe'),
        'bi-bar-chart' => __('图表可视', 'zheshe'),
        'bi-cash-coin' => __('理财', 'zheshe'),
        'bi-cart' => __('好物购物', 'zheshe'),
        'bi-houses' => __('家居', 'zheshe'),
        'bi-building' => __('城市建筑', 'zheshe'),
        'bi-sun' => __('阳光心情', 'zheshe'),
        'bi-cloud' => __('天气自然', 'zheshe'),
        'bi-emoji-smile' => __('趣味', 'zheshe'),
        'bi-heart' => __('情感', 'zheshe'),
        'bi-star' => __('收藏推荐', 'zheshe'),
        'bi-bookmark' => __('资料收藏', 'zheshe'),
        'bi-archive' => __('归档', 'zheshe'),
        'bi-globe' => __('环球视野', 'zheshe'),
        'bi-key' => __('账号安全', 'zheshe'),
        'bi-shield-lock' => __('网络安全', 'zheshe'),
        'bi-calendar' => __('日程规划', 'zheshe'),
        'bi-stopwatch' => __('效率时间', 'zheshe'),
    );
}

function zheshe_is_category_admin_page($hook) {
    if (!in_array($hook, array('edit-tags.php', 'term.php'), true)) return false;
    $taxonomy = isset($_GET['taxonomy']) ? wp_unslash($_GET['taxonomy']) : '';
    return 'category' === $taxonomy;
}

function zheshe_admin_category_icon_assets($hook) {
    if (!zheshe_is_category_admin_page($hook)) return;
    wp_enqueue_style(
        'bootstrap-icons',
        zheshe_asset_url('bootstrap-icons/bootstrap-icons.min.css', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css'),
        array(),
        '1.11.1'
    );
}
add_action('admin_enqueue_scripts', 'zheshe_admin_category_icon_assets');

function zheshe_category_icon_add_field() {
    wp_nonce_field('zheshe_category_icon_save', 'zheshe_category_icon_nonce');
    ?>
    <div class="form-field">
        <label for="zheshe-category-icon"><?php _e('Category icon', 'zheshe'); ?></label>
        <select id="zheshe-category-icon" name="zheshe_category_icon" class="postform">
            <option value=""><?php _e('Auto (default)', 'zheshe'); ?></option>
            <?php foreach (zheshe_category_icon_choices() as $class => $label) : ?>
                <option value="<?php echo esc_attr($class); ?>"><?php echo esc_html($label . ' — ' . $class); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="description">
            <i id="zheshe-category-icon-preview" class="bi bi-journal-text" style="font-size:1.25rem;vertical-align:middle;"></i>
            <?php _e('Displayed beside the category name in the sidebar.', 'zheshe'); ?>
        </p>
    </div>
    <?php
}
add_action('category_add_form_fields', 'zheshe_category_icon_add_field');

function zheshe_category_icon_edit_field($term) {
    $current = get_term_meta($term->term_id, 'zheshe_category_icon', true);
    if (empty($current) || !array_key_exists($current, zheshe_category_icon_choices())) $current = '';
    wp_nonce_field('zheshe_category_icon_save', 'zheshe_category_icon_nonce');
    ?>
    <tr class="form-field">
        <th scope="row"><label for="zheshe-category-icon"><?php _e('Category icon', 'zheshe'); ?></label></th>
        <td>
            <select id="zheshe-category-icon" name="zheshe_category_icon" class="postform">
                <option value=""><?php _e('Auto (default)', 'zheshe'); ?></option>
                <?php foreach (zheshe_category_icon_choices() as $class => $label) : ?>
                    <option value="<?php echo esc_attr($class); ?>" <?php selected($current, $class); ?>><?php echo esc_html($label . ' — ' . $class); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description">
                <i id="zheshe-category-icon-preview" class="bi <?php echo esc_attr($current ? $current : 'bi-journal-text'); ?>" style="font-size:1.25rem;vertical-align:middle;"></i>
                <?php _e('Displayed beside the category name in the sidebar.', 'zheshe'); ?>
            </p>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'zheshe_category_icon_edit_field');

function zheshe_save_category_icon($term_id) {
    if (!current_user_can('manage_categories')) return;
    if (!isset($_POST['zheshe_category_icon_nonce']) || !wp_verify_nonce($_POST['zheshe_category_icon_nonce'], 'zheshe_category_icon_save')) return;
    if (!isset($_POST['taxonomy']) || 'category' !== wp_unslash($_POST['taxonomy'])) return;
    if (isset($_POST['zheshe_category_icon']) && array_key_exists(wp_unslash($_POST['zheshe_category_icon']), zheshe_category_icon_choices())) {
        update_term_meta($term_id, 'zheshe_category_icon', sanitize_key(wp_unslash($_POST['zheshe_category_icon'])));
    } else {
        delete_term_meta($term_id, 'zheshe_category_icon');
    }
}
add_action('created_category', 'zheshe_save_category_icon');
add_action('edited_category', 'zheshe_save_category_icon');

function zheshe_category_icon_preview_script($hook) {
    if (!zheshe_is_category_admin_page($hook)) return;
    ?>
    <script>
    (function () {
        var select = document.getElementById('zheshe-category-icon');
        var preview = document.getElementById('zheshe-category-icon-preview');
        if (!select || !preview) return;
        function update() {
            preview.className = 'bi ' + (select.value || 'bi-journal-text');
        }
        select.addEventListener('change', update);
        update();
    })();
    </script>
    <?php
}
add_action('admin_print_footer_scripts', 'zheshe_category_icon_preview_script');

function zheshe_has_subscription_plugin() {
    if (class_exists('Jetpack') && method_exists('Jetpack', 'is_module_active') && Jetpack::is_module_active('subscriptions')) {
        return 'jetpack';
    }
    if (class_exists('MC4WP_Mailchimp')) {
        return 'mailchimp';
    }
    if (function_exists('mc4wp_show_form')) {
        return 'mailchimp';
    }
    return false;
}

function zheshe_subscription_form() {
    $provider = zheshe_has_subscription_plugin();
    if (!$provider) return '';

    ob_start();
    if ($provider === 'jetpack') :
    ?>
      <div class="sidebar-card card subscribe-card">
        <div class="card-body">
          <h5 class="mb-2"><i class="bi bi-envelope-heart me-2"></i><?php _e('Subscribe Updates', 'zheshe'); ?></h5>
          <p class="small opacity-75 mb-3"><?php _e('Get notified of new posts', 'zheshe'); ?></p>
          <?php echo do_shortcode('[jetpack_subscription_form]'); ?>
        </div>
      </div>
    <?php
    elseif ($provider === 'mailchimp') :
    ?>
      <div class="sidebar-card card subscribe-card">
        <div class="card-body">
          <h5 class="mb-2"><i class="bi bi-envelope-heart me-2"></i><?php _e('Subscribe Updates', 'zheshe'); ?></h5>
          <p class="small opacity-75 mb-3"><?php _e('Get notified of new posts', 'zheshe'); ?></p>
          <?php mc4wp_show_form(); ?>
        </div>
      </div>
    <?php
    endif;
    return ob_get_clean();
}

function zheshe_custom_logo() {
    if (has_custom_logo()) {
        return get_custom_logo();
    }
    return '<a class="navbar-brand fw-bold" href="' . esc_url(home_url('/')) . '"><i class="bi bi-journal-richtext text-primary me-1"></i>' . get_bloginfo('name') . '</a>';
}

/* ========================================================================
 * Customizer：首页 Hero 文案（此前只读取 get_theme_mod 却未注册设置，
 * 导致后台没有入口，只能改代码）
 * ===================================================================== */
function zheshe_customize_register($wp_customize) {
    $wp_customize->add_section('zheshe_hero', array(
        'title' => __('Home Hero', 'zheshe'),
        'description' => __('Customize the headline area of the blog homepage.', 'zheshe'),
        'priority' => 30,
        'active_callback' => function () {
            // 仅在首页/博客主页相关页面显示该面板
            return is_home() || is_front_page() || is_customize_preview();
        },
    ));

    $wp_customize->add_setting('zheshe_hero_title', array(
        'default' => __('Share knowledge, record life', 'zheshe'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('zheshe_hero_title', array(
        'label' => __('Hero Title', 'zheshe'),
        'section' => 'zheshe_hero',
        'type' => 'text',
    ));

    $wp_customize->add_setting('zheshe_hero_subtitle', array(
        'default' => __('Explore technology, life and travel, find resonance here.', 'zheshe'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('zheshe_hero_subtitle', array(
        'label' => __('Hero Subtitle', 'zheshe'),
        'section' => 'zheshe_hero',
        'type' => 'textarea',
    ));

    // Hero 背景内置两种配色，随主题 evolve 可继续扩展
    $wp_customize->add_setting('zheshe_hero_style', array(
        'default' => 'gradient',
        'sanitize_callback' => 'zheshe_sanitize_choice',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('zheshe_hero_style', array(
        'label' => __('Hero Style', 'zheshe'),
        'section' => 'zheshe_hero',
        'type' => 'select',
        'choices' => array(
            'gradient' => __('Purple-Blue Gradient', 'zheshe'),
            'dark' => __('Solid Dark', 'zheshe'),
        ),
    ));

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
}
add_action('customize_register', 'zheshe_customize_register');

function zheshe_sanitize_choice($input, $setting) {
    $choices = $setting->manager->get_control($setting->id)->choices;
    return array_key_exists($input, $choices) ? $input : $setting->default;
}

function zheshe_customize_preview_js() {
    wp_enqueue_script(
        'zheshe-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('customize-preview'),
        '1.1.0',
        true
    );
}
add_action('customize_preview_init', 'zheshe_customize_preview_js');

/* ========================================================================
 * 分页：输出 Bootstrap 5 结构（paginate_links 默认输出的是 page-numbers 类，
 * Bootstrap 不认，所以分页一直是裸链接）
 * ===================================================================== */
function zheshe_pagination($args = array()) {
    $links = paginate_links(wp_parse_args($args, array(
        'type' => 'array',
        'prev_text' => '<i class="bi bi-chevron-left"></i>',
        'next_text' => '<i class="bi bi-chevron-right"></i>',
        'mid_size' => 1,
    )));

    if (!is_array($links) || empty($links)) {
        return;
    }

    echo '<nav class="mt-4" aria-label="' . esc_attr__('Posts navigation', 'zheshe') . '">';
    echo '<ul class="pagination justify-content-center flex-wrap">';
    foreach ($links as $link) {
        $item_class = 'page-item';
        if (false !== strpos($link, 'current')) {
            $item_class .= ' active';
        } elseif (false !== strpos($link, 'dots')) {
            $item_class .= ' disabled';
        }
        $link = str_replace('page-numbers', 'page-link', $link);
        if (false !== strpos($link, 'current')) {
            $link = str_replace('<a', '<a aria-current="page"', $link);
        }
        echo '<li class="' . esc_attr($item_class) . '">' . $link . '</li>';
    }
    echo '</ul></nav>';
}

// 文章内分页（wp_link_pages）同样补上 Bootstrap 的 page-item / page-link 类
function zheshe_link_pages_link($link) {
    if (false === strpos($link, 'class=')) {
        $link = str_replace('<a href=', '<a class="page-link" href=', $link);
    } else {
        $link = preg_replace('/class="([^"]*)"/', 'class="$1 page-link"', $link, 1);
    }
    return $link;
}
add_filter('wp_link_pages_link', 'zheshe_link_pages_link');

/* ========================================================================
 * 评论列表渲染回调：让 custom.css 中的 .comment-card 等样式真正生效
 * ===================================================================== */
function zheshe_comment_callback($comment, $args, $depth) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-card card border-0 shadow-sm mb-3'); ?>>
      <div class="card-body">
        <div class="d-flex gap-3">
          <?php if (0 !== $args['avatar_size']) : ?>
            <?php echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'rounded-circle flex-shrink-0')); ?>
          <?php endif; ?>
          <div class="flex-grow-1">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
              <span class="fw-bold"><?php comment_author(); ?></span>
              <a class="small text-muted text-decoration-none" href="<?php echo esc_url(get_comment_link($comment)); ?>">
                <time datetime="<?php comment_time('c'); ?>"><?php comment_date(); ?> <?php comment_time(); ?></time>
              </a>
              <?php edit_comment_link(__('Edit', 'zheshe'), '<span class="small">', '</span>'); ?>
            </div>

            <?php if ('0' === $comment->comment_approved) : ?>
              <p class="small text-warning-emphasis mb-2"><?php _e('Your comment is awaiting moderation.', 'zheshe'); ?></p>
            <?php endif; ?>

            <div class="comment-content small">
              <?php comment_text(); ?>
            </div>

            <div class="mt-2">
              <?php
              comment_reply_link(array_merge($args, array(
                  'depth' => $depth,
                  'add_below' => 'comment',
                  'reply_text' => '<i class="bi bi-reply me-1"></i>' . __('Reply', 'zheshe'),
                  'class' => 'btn btn-sm btn-outline-secondary rounded-pill',
              )));
              ?>
            </div>
          </div>
        </div>
      </div>
    </<?php echo $tag; ?>>
    <?php
}