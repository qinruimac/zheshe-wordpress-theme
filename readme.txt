=== Zheshe ===

Contributors: qinruimac
Requires at least: 6.0
Tested up to: 7.1.3
Requires PHP: 7.4
Stable tag: 1.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, two-columns, right-sidebar, custom-colors, custom-menu, custom-logo, featured-images, threaded-comments, translation-ready, sticky-post, responsive-layout

== Description ==

Zheshe（折射）is a modern WordPress blog theme built on Bootstrap 5, with a purple-blue gradient style and a fully responsive layout.

棱镜折射多彩光芒 —— Zheshe 是一款面向个人博客的轻量主题，开箱即用：首页特色文章 + 双列文章网格、分类侧边栏、标签云、热门文章、站内搜索、浏览量统计与阅读时长估算。

Features:

* Home page featured post + two-column post grid (posts without a featured image simply render no image slot)
* Category sidebar with a custom icon for each category (40+ Bootstrap Icons)
* Tag cloud, popular posts (sorted by view count), site search
* Per-post view counting with bot/preview filtering and IP de-duplication
* Smart reading-time estimation for mixed Chinese/English content
* Comment template with nested replies, compatible with Jetpack / Mailchimp subscription
* Mobile collapsible navigation, custom menus and custom logo support
* Customizer panel for the home page Hero (title, subtitle and style) with live preview
* Bootstrap 5 and Bootstrap Icons bundled locally — no CDN dependency
* Accessibility: skip link, main landmark, ARIA labels on navigation
* Translation ready, includes a complete Simplified Chinese language pack (121 strings)

== Installation ==

1. In your WordPress dashboard, go to Appearance → Themes → Add New → Upload Theme.
2. Choose `zheshe.zip` and click Install Now.
3. Click Activate.
4. (Optional) Go to Appearance → Customize → Home Hero to set the headline and subtitle.
5. (Optional) Go to Appearance → Menus to assign the Primary and Footer menus.
6. (Optional) Go to Posts → Categories → Edit to pick an icon for each category.

Upgrading: WordPress cannot overwrite a theme by uploading a ZIP. To upgrade, download
`zheshe.zip` from the release, extract it locally, and upload the files over
`wp-content/themes/zheshe/` via FTP. The theme slug stays the same, so your Customizer
settings, menus and widgets are preserved.

== Frequently Asked Questions ==

= How do I change the home page headline? =

Go to Appearance → Customize → Home Hero. You can set the title, subtitle and the Hero style
(purple-blue gradient or solid dark), with live preview.

= Why is the reading time always 1 minute for Chinese posts? =

It is not. Zheshe counts English by words (200 wpm) and Chinese by characters (400 cpm), so
mixed-language posts get a sensible estimate.

= Do I need a plugin for the subscription form? =

No, but the theme integrates with Jetpack or Mailchimp if either is active. Without them the
sidebar simply shows a search box instead.

= Is Bootstrap loaded from a CDN? =

No. Bootstrap 5.3.2 and Bootstrap Icons 1.11.1 are bundled in `assets/vendor/`. If you prefer
the CDN, a child theme can use `add_filter('zheshe_use_local_assets', '__return_false');`.

== Screenshots ==

1. Home page with the featured post and the two-column post grid
2. Single post with comments
3. Category archive with the sidebar

== Changelog ==

= 1.4.2 =
* Theme CSS/JS assets are now enqueued with the file modification timestamp as the version
  parameter, so caches (Cloudflare, browsers) pick up changes immediately on every update
* Dropped the separate overlay package; zheshe.zip now serves both installs and manual upgrades

= 1.4.1 =
* Added universal widget styling so default WordPress widgets (Recent Posts, Categories,
  Search, Tag Cloud, RSS, Meta) match the theme card look: dashed separators, hover accents,
  themed search form and tag badges

= 1.4.0 =
* Refactored the sidebar to be fully widget-driven (official WordPress practice)
* All default sidebar modules became real widgets: Zheshe Search, Categories (with theme icons),
  Tag Cloud, Popular Posts (by view count) and Subscribe
* On theme activation an empty sidebar is seeded with the default layout; existing widget
  configurations are never touched
* Language pack expanded to 144 strings

= 1.3.0 =
* Added the "Button Links" sidebar widget: one line per button (Name|URL|Icon), ideal for
  blog-network buttons such as Ten-Year Pact or blog wormhole links
* Wired up the registered widget areas — "Blog Sidebar" now renders above the category card,
  and "Footer Area" renders after the footer columns (previously they were registered but never displayed)
* Language pack expanded to 129 strings

= 1.2.0 =
* Renamed the theme to Zheshe; theme slug, Text Domain and function prefix are now consistent
* Namespaced the database keys: `post_views` → `zheshe_post_views`, `blog_hero_*` → `zheshe_hero_*`,
  with automatic migration of existing data (no loss when upgrading)
* Added readme.txt for the WordPress.org theme directory
* Regenerated the Simplified Chinese language pack (121 strings)

= 1.1.0 =
* Added the Customizer "Home Hero" panel (title, subtitle, style) with live preview
* Added Bootstrap 5 markup for pagination and a custom comment callback
* All post containers now use `post_class()`, so sticky post styling works
* Added searchform.php, theme.json, editor-style.css, add_image_size() and $content_width
* Bundled Bootstrap 5.3.2 and Bootstrap Icons locally instead of using a CDN
* View counting moved to the `wp` hook with bot, preview and IP de-duplication
* Accessibility: skip link, main landmark, ARIA labels
* Language pack expanded from 56 to 121 translated strings

= 1.0.0 =
* First public release

== Upgrade Notice ==

= 1.2.0 =
Renamed to Zheshe. Existing Customizer Hero settings and post view counts are migrated
automatically; nothing is lost. Because the theme slug changed, please activate Zheshe once
from Appearance → Themes after upgrading.

== Credits ==

* Bootstrap 5.3.2 — https://getbootstrap.com/ — MIT License
* Bootstrap Icons 1.11.1 — https://icons.getbootstrap.com/ — MIT License
* Bundled under GPLv2 or later, consistent with WordPress licensing.
