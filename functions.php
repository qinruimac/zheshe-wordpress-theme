<?php
if (!defined('ABSPATH')) exit;

function prism_setup() {
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
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'prism'),
        'footer' => __('Footer Menu', 'prism'),
    ));
}

add_action('after_setup_theme', 'prism_setup');

function prism_load_textdomain() {
    $locale = get_locale();
    $mo_file = get_template_directory() . '/languages/prism-' . $locale . '.mo';
    if (file_exists($mo_file)) {
        load_textdomain('prism', $mo_file);
    }
    load_theme_textdomain('prism', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'prism_load_textdomain', 5);

function prism_scripts() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2');
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css', array(), '1.11.1');
    wp_enqueue_style('prism-style', get_stylesheet_uri(), array('bootstrap', 'bootstrap-icons'), '1.0.0');
    wp_enqueue_style('prism-custom', get_template_directory_uri() . '/assets/css/custom.css', array('prism-style'), '1.0.0');

    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true);
    wp_enqueue_script('prism-main', get_template_directory_uri() . '/assets/js/main.js', array('bootstrap'), '1.0.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'prism_scripts');

function prism_widgets_init() {
    register_sidebar(array(
        'name' => __('博客侧边栏', 'prism'),
        'id' => 'sidebar-1',
        'description' => __('显示在博客页面右侧的侧边栏', 'prism'),
        'before_widget' => '<div class="sidebar-card card"><div class="card-body">',
        'after_widget' => '</div></div>',
        'before_title' => '<h5 class="mb-3">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => __('底部区域', 'prism'),
        'id' => 'footer-1',
        'description' => __('显示在页面底部的组件区域', 'prism'),
        'before_widget' => '<div class="col-md-3 mb-3">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="fw-bold mb-2">',
        'after_title' => '</h6>',
    ));
}
add_action('widgets_init', 'prism_widgets_init');

function prism_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'prism_excerpt_length');

function prism_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'prism_excerpt_more');

function prism_post_categories() {
    $categories = get_the_category();
    if (empty($categories)) return '';
    $output = '';
    foreach ($categories as $cat) {
        $color = prism_category_color($cat->term_id);
        $output .= '<a href="' . esc_url(get_category_link($cat->term_id)) . '" class="badge bg-' . $color . ' mb-2 me-1 text-decoration-none">' . esc_html($cat->name) . '</a>';
    }
    return $output;
}

function prism_category_color($cat_id) {
    $colors = array('primary', 'success', 'info', 'warning', 'danger');
    return $colors[$cat_id % count($colors)];
}

function prism_reading_time() {
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

function prism_post_views() {
    $views = get_post_meta(get_the_ID(), 'post_views', true);
    if (empty($views)) $views = 0;
    return prism_format_views($views);
}

function prism_format_views($views) {
    if ($views >= 1000) {
        return number_format($views / 1000, 1) . 'k';
    }
    return $views;
}

function prism_update_views() {
    if (is_single()) {
        $post_id = get_the_ID();
        $views = get_post_meta($post_id, 'post_views', true);
        if (empty($views)) $views = 0;
        update_post_meta($post_id, 'post_views', $views + 1);
    }
}
add_action('wp_head', 'prism_update_views');

function prism_category_icon($cat_id) {
    $custom = get_term_meta($cat_id, 'prism_category_icon', true);
    if (!empty($custom) && array_key_exists($custom, prism_category_icon_choices())) {
        return $custom;
    }
    $icons = array('bi-code', 'bi-cup-hot', 'bi-airplane', 'bi-book', 'bi-music-note-beamed', 'bi-camera', 'bi-heart', 'bi-star', 'bi-lightbulb', 'bi-globe');
    return $icons[$cat_id % count($icons)];
}

function prism_category_icon_choices() {
    return array(
        'bi-journal-text' => __('随笔 / 博客', 'prism'),
        'bi-newspaper' => __('资讯 / 新闻', 'prism'),
        'bi-code' => __('编程开发', 'prism'),
        'bi-terminal' => __('命令行', 'prism'),
        'bi-github' => __('开源项目', 'prism'),
        'bi-robot' => __('人工智能', 'prism'),
        'bi-cpu' => __('硬件数码', 'prism'),
        'bi-lightbulb' => __('想法灵感', 'prism'),
        'bi-mortarboard' => __('学习笔记', 'prism'),
        'bi-book' => __('读书', 'prism'),
        'bi-tools' => __('教程工具', 'prism'),
        'bi-wrench' => __('DIY 维修', 'prism'),
        'bi-bug' => __('问题排查', 'prism'),
        'bi-cup-hot' => __('咖啡生活', 'prism'),
        'bi-airplane' => __('旅行游记', 'prism'),
        'bi-camera' => __('摄影', 'prism'),
        'bi-mountain' => __('户外露营', 'prism'),
        'bi-map' => __('地图探索', 'prism'),
        'bi-music-note-beamed' => __('音乐', 'prism'),
        'bi-film' => __('影视', 'prism'),
        'bi-controller' => __('游戏', 'prism'),
        'bi-palette' => __('设计美学', 'prism'),
        'bi-chat-dots' => __('闲聊杂谈', 'prism'),
        'bi-people' => __('团队协作', 'prism'),
        'bi-person' => __('个人成长', 'prism'),
        'bi-briefcase' => __('职场', 'prism'),
        'bi-graph-up' => __('数据分析', 'prism'),
        'bi-bar-chart' => __('图表可视', 'prism'),
        'bi-cash-coin' => __('理财', 'prism'),
        'bi-cart' => __('好物购物', 'prism'),
        'bi-houses' => __('家居', 'prism'),
        'bi-building' => __('城市建筑', 'prism'),
        'bi-sun' => __('阳光心情', 'prism'),
        'bi-cloud' => __('天气自然', 'prism'),
        'bi-emoji-smile' => __('趣味', 'prism'),
        'bi-heart' => __('情感', 'prism'),
        'bi-star' => __('收藏推荐', 'prism'),
        'bi-bookmark' => __('资料收藏', 'prism'),
        'bi-archive' => __('归档', 'prism'),
        'bi-globe' => __('环球视野', 'prism'),
        'bi-key' => __('账号安全', 'prism'),
        'bi-shield-lock' => __('网络安全', 'prism'),
        'bi-calendar' => __('日程规划', 'prism'),
        'bi-stopwatch' => __('效率时间', 'prism'),
    );
}

function prism_is_category_admin_page($hook) {
    if (!in_array($hook, array('edit-tags.php', 'term.php'), true)) return false;
    $taxonomy = isset($_GET['taxonomy']) ? wp_unslash($_GET['taxonomy']) : '';
    return 'category' === $taxonomy;
}

function prism_admin_category_icon_assets($hook) {
    if (!prism_is_category_admin_page($hook)) return;
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css', array(), '1.11.1');
}
add_action('admin_enqueue_scripts', 'prism_admin_category_icon_assets');

function prism_category_icon_add_field() {
    wp_nonce_field('prism_category_icon_save', 'prism_category_icon_nonce');
    ?>
    <div class="form-field">
        <label for="prism-category-icon"><?php _e('Category icon', 'prism'); ?></label>
        <select id="prism-category-icon" name="prism_category_icon" class="postform">
            <option value=""><?php _e('Auto (default)', 'prism'); ?></option>
            <?php foreach (prism_category_icon_choices() as $class => $label) : ?>
                <option value="<?php echo esc_attr($class); ?>"><?php echo esc_html($label . ' — ' . $class); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="description">
            <i id="prism-category-icon-preview" class="bi bi-journal-text" style="font-size:1.25rem;vertical-align:middle;"></i>
            <?php _e('Displayed beside the category name in the sidebar.', 'prism'); ?>
        </p>
    </div>
    <?php
}
add_action('category_add_form_fields', 'prism_category_icon_add_field');

function prism_category_icon_edit_field($term) {
    $current = get_term_meta($term->term_id, 'prism_category_icon', true);
    if (empty($current) || !array_key_exists($current, prism_category_icon_choices())) $current = '';
    wp_nonce_field('prism_category_icon_save', 'prism_category_icon_nonce');
    ?>
    <tr class="form-field">
        <th scope="row"><label for="prism-category-icon"><?php _e('Category icon', 'prism'); ?></label></th>
        <td>
            <select id="prism-category-icon" name="prism_category_icon" class="postform">
                <option value=""><?php _e('Auto (default)', 'prism'); ?></option>
                <?php foreach (prism_category_icon_choices() as $class => $label) : ?>
                    <option value="<?php echo esc_attr($class); ?>" <?php selected($current, $class); ?>><?php echo esc_html($label . ' — ' . $class); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description">
                <i id="prism-category-icon-preview" class="bi <?php echo esc_attr($current ? $current : 'bi-journal-text'); ?>" style="font-size:1.25rem;vertical-align:middle;"></i>
                <?php _e('Displayed beside the category name in the sidebar.', 'prism'); ?>
            </p>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'prism_category_icon_edit_field');

function prism_save_category_icon($term_id) {
    if (!current_user_can('manage_categories')) return;
    if (!isset($_POST['prism_category_icon_nonce']) || !wp_verify_nonce($_POST['prism_category_icon_nonce'], 'prism_category_icon_save')) return;
    if (!isset($_POST['taxonomy']) || 'category' !== wp_unslash($_POST['taxonomy'])) return;
    if (isset($_POST['prism_category_icon']) && array_key_exists(wp_unslash($_POST['prism_category_icon']), prism_category_icon_choices())) {
        update_term_meta($term_id, 'prism_category_icon', sanitize_key(wp_unslash($_POST['prism_category_icon'])));
    } else {
        delete_term_meta($term_id, 'prism_category_icon');
    }
}
add_action('created_category', 'prism_save_category_icon');
add_action('edited_category', 'prism_save_category_icon');

function prism_category_icon_preview_script($hook) {
    if (!prism_is_category_admin_page($hook)) return;
    ?>
    <script>
    (function () {
        var select = document.getElementById('prism-category-icon');
        var preview = document.getElementById('prism-category-icon-preview');
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
add_action('admin_print_footer_scripts', 'prism_category_icon_preview_script');

function prism_has_subscription_plugin() {
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

function prism_subscription_form() {
    $provider = prism_has_subscription_plugin();
    if (!$provider) return '';

    ob_start();
    if ($provider === 'jetpack') :
    ?>
      <div class="sidebar-card card subscribe-card">
        <div class="card-body">
          <h5 class="mb-2"><i class="bi bi-envelope-heart me-2"></i><?php _e('Subscribe Updates', 'prism'); ?></h5>
          <p class="small opacity-75 mb-3"><?php _e('Get notified of new posts', 'prism'); ?></p>
          <?php echo do_shortcode('[jetpack_subscription_form]'); ?>
        </div>
      </div>
    <?php
    elseif ($provider === 'mailchimp') :
    ?>
      <div class="sidebar-card card subscribe-card">
        <div class="card-body">
          <h5 class="mb-2"><i class="bi bi-envelope-heart me-2"></i><?php _e('Subscribe Updates', 'prism'); ?></h5>
          <p class="small opacity-75 mb-3"><?php _e('Get notified of new posts', 'prism'); ?></p>
          <?php mc4wp_show_form(); ?>
        </div>
      </div>
    <?php
    endif;
    return ob_get_clean();
}

function prism_custom_logo() {
    if (has_custom_logo()) {
        return get_custom_logo();
    }
    return '<a class="navbar-brand fw-bold" href="' . esc_url(home_url('/')) . '"><i class="bi bi-journal-richtext text-primary me-1"></i>' . get_bloginfo('name') . '</a>';
}