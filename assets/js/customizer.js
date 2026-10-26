/**
 * Customizer 实时预览（postMessage）
 */
(function ($) {
  wp.customize('blog_hero_title', function (value) {
    value.bind(function (to) {
      $('.blog-hero h1').text(to);
    });
  });

  wp.customize('blog_hero_subtitle', function (value) {
    value.bind(function (to) {
      $('.blog-hero .lead').text(to);
    });
  });
})(jQuery);
