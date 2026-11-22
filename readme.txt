=== Zheshe ===

Contributors: qinruimac
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.4.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, two-columns, right-sidebar, custom-colors, custom-menu, custom-logo, featured-images, threaded-comments, translation-ready, sticky-post

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
* Translation ready, includes a complete Simplified Chinese language pack

== Installation ==

1. In your WordPress dashboard, go to Appearance → Themes → Add New → Upload Theme.
2. Choose the versioned theme ZIP package (`zheshe_vX.Y.Z.zip`) and click Install Now.
3. Click Activate.
4. (Optional) Go to Appearance → Customize → Home Hero to set the headline and subtitle.
5. (Optional) Go to Appearance → Menus to assign the Primary and Footer menus.
6. (Optional) Go to Posts → Categories → Edit to pick an icon for each category.
7. (Optional) Go to Appearance → Widgets → Blog Sidebar to add widgets. On a brand-new site,
   Appearance → Customize offers the default Zheshe sidebar (Search, Categories, Tag Cloud,
   Popular Posts, Subscribe) as starter content; it is only applied when you publish it.

== Frequently Asked Questions ==

= How do I change the home page headline? =

Go to Appearance → Customize → Home Hero. You can set the title, subtitle and the Hero style
(purple-blue gradient or solid dark), with live preview.

= Why is the reading time always 1 minute for Chinese posts? =

It is not. Zheshe counts English by words (200 wpm) and Chinese by characters (400 cpm), so
mixed-language posts get a sensible estimate.

= Do I need a plugin for the subscription form? =

No, but the theme integrates with Jetpack or Mailchimp if either is active. Without them the
"Zheshe: Subscribe" widget renders nothing.

= Why is the sidebar empty after activating the theme? =

Zheshe does not create widgets on your behalf. Add widgets in Appearance → Widgets → Blog
Sidebar, or—on a brand-new site—publish the starter content offered in Appearance → Customize.

= How many posts does the home page show? =

As many as "Settings → Reading → Blog pages show at most". The first post on the first page is
displayed as a large featured card. With a static front page, the page content is shown first,
followed by the latest posts.

= Is Bootstrap loaded from a CDN? =

No. Bootstrap 5.3.2 and Bootstrap Icons 1.11.1 are bundled in `assets/vendor/`. If you prefer
the CDN, a child theme can use `add_filter('zheshe_use_local_assets', '__return_false');`.

== Screenshots ==

1. Home page with the featured post and the two-column post grid
2. Single post with comments
3. Category archive with the sidebar

== Changelog ==

= 1.4.8 =
* Added two custom block styles (gradient button and accent quote) via register_block_style(),
  and a "Featured Intro" block pattern via register_block_pattern(), addressing the Theme Check
  recommendations for the transition to block themes
* The footer credit link now reads the theme Author URI, is escaped with esc_url(), and can be
  replaced or removed using the zheshe_credit_url / zheshe_show_credit filters; no hard-coded
  URLs remain in templates
* Added 5 new translatable strings and rebuilt the Simplified Chinese language pack (154 entries)
* Build artifacts are now named zheshe_vX.Y.Z.zip (e.g. zheshe_v1.4.8.zip); the release
  workflow now verifies that the tag matches the Version header in style.css before publishing
* No settings or content changes

= 1.4.7 =
* All translatable strings echoed in templates and widget forms are now escaped with
  esc_html_e() / esc_html__(); additional escaping added for the search field value,
  custom-logo fallback, archive titles and description, dates, charset and comment counts
* Removed dead subscribe-form JavaScript that targeted a selector which does not exist
  in the theme and contained a hard-coded, non-translatable Chinese string
* The style.css Description is now in English for the theme directory listing
* Added WordPress core CSS classes (alignleft, alignright, aligncenter, wp-caption,
  wp-caption-text, gallery-caption, bypostauthor, screen-reader-text) and declared
  custom-background support
* No visual changes and no new translatable strings: the language pack stays in sync

= 1.4.6 =
* The theme no longer writes widgets on activation or on every admin page load: the automatic
  sidebar seeding (and its `zheshe_sidebar_seeded` option) was removed. The default sidebar
  layout is now offered as starter content, applied only when the user publishes it in the Customizer
* The legacy `post_views` migration no longer runs on `admin_init`; it runs only when a user who can
  switch themes activates Zheshe (no more `zheshe_views_migrated` flag). Single posts are still
  migrated lazily when their view count is read
* The home page uses the main loop: posts per page follow Settings → Reading, sticky posts are
  handled by WordPress (marked with `.sticky`, never duplicated), pagination uses the main query
* `index.php` and `front-page.php` share the new `template-parts/post-list.php`; on a static front
  page the page content is shown first, then the latest posts
* The category icon preview script is enqueued with `wp_add_inline_script()` (it was previously
  printed on a hook that never matched the category screen, so the preview did not update)
* Inline `style` attributes in templates replaced with CSS classes (`.zheshe-hero-icon`,
  `.zheshe-empty-icon`); comment avatar size passed via the `--zheshe-avatar-size` CSS variable
* "Zheshe: Search" widget now renders through `searchform.php` / `get_search_form()`, with a
  visually hidden label; search field IDs are unique per page
* Footer credit strings are translatable
* Asset versions fall back to the theme version when `filemtime()` fails (read-only file systems)
* theme.json: added a font family preset and disabled the core default palette so the theme
  palette is used in the editor
* Metadata: "Tested up to" uses the major version format (7.1; tested on WordPress 7.1.5),
  removed the deprecated `responsive-layout` tag, language pack re-extracted and its header updated
* readme.txt: added Copyright, Resources and expanded Credits; removed the outdated manual
  upgrade instructions

= 1.4.5 =
* Comment avatars now use a fixed-size wrapper with explicit width/height, so they stay
  perfectly circular and square regardless of 2x srcset or content image rules
* Comment author names are links again (comment_author_link()), pointing to the commenter's
  website when one was provided, with nofollow/ugc rel attributes
* Sidebar "Recent Comments" avatars also pinned to a fixed circular size

= 1.4.4 =
* Fixed sidebar dropping below the content on posts with comments: the custom comment
  callback now suppresses the extra closing div emitted by Walker_Comment (end-callback)
* Fixed distorted avatars: .single-post-content img no longer overrides avatar shape/size
* Comment form reply title uses a single h5 wrapper (no more h3 > h5 nesting)
* Added indentation for nested replies when comments use div style

= 1.4.3 =
* Sidebar widget titles added via the block editor (independent H2 blocks) are now unified
  to the theme heading style via CSS, so every widget title looks the same
* Excerpts strip leading Markdown markers (##, >) so they no longer leak into the post grid

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

= 1.4.8 =
Theme Check follow-up: block styles, a block pattern and a configurable footer credit link.
No settings or content changes; a straightforward update.

= 1.4.7 =
Compliance follow-up to 1.4.6. No settings or content changes; a straightforward update.

= 1.4.6 =
WordPress.org compliance release. Your existing widgets, menus and Customizer settings are kept;
the theme simply no longer adds widgets by itself. The home page now shows as many posts as
Settings → Reading specifies (previously fixed at 7).

= 1.2.0 =
Renamed to Zheshe. Existing Customizer Hero settings and post view counts are migrated
automatically; nothing is lost. Because the theme slug changed, please activate Zheshe once
from Appearance → Themes after upgrading.

== Copyright ==

Zheshe WordPress Theme, Copyright 2026 eRui.org
Zheshe is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

The full license text is in the LICENSE file shipped with the theme.

Zheshe bundles the following third-party resources:

Bootstrap v5.3.2, Copyright 2011-2023 The Bootstrap Authors
License: MIT
Source: https://github.com/twbs/bootstrap/blob/v5.3.2/LICENSE

Bootstrap Icons v1.11.1, Copyright 2019-2023 The Bootstrap Authors
License: MIT
Source: https://github.com/twbs/icons/blob/v1.11.1/LICENSE
The icon font files (bootstrap-icons.woff2, bootstrap-icons.woff) are taken unchanged from the
official Bootstrap Icons 1.11.1 release: not subset or otherwise modified.

MIT License text (applies to Bootstrap and Bootstrap Icons):

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

== Resources ==

All files in `assets/vendor/` are the official distribution files of the versions listed below.
They are not modified, re-minified or obfuscated; the original copyright headers are kept, and the
version numbers match the upstream releases.

* assets/vendor/bootstrap/css/bootstrap.min.css
  Bootstrap v5.3.2 (dist/css/bootstrap.min.css), MIT License, https://getbootstrap.com/
  Unminified source: https://github.com/twbs/bootstrap/tree/v5.3.2/scss
* assets/vendor/bootstrap/js/bootstrap.bundle.min.js
  Bootstrap v5.3.2 (dist/js/bootstrap.bundle.min.js, includes Popper), MIT License, https://getbootstrap.com/
  Unminified source: https://github.com/twbs/bootstrap/tree/v5.3.2/js
* assets/vendor/bootstrap-icons/bootstrap-icons.min.css
  Bootstrap Icons v1.11.1 (font/bootstrap-icons.min.css), MIT License, https://icons.getbootstrap.com/
  Unminified source: https://github.com/twbs/icons/blob/v1.11.1/font/bootstrap-icons.css
* assets/vendor/bootstrap-icons/fonts/bootstrap-icons.woff2
* assets/vendor/bootstrap-icons/fonts/bootstrap-icons.woff
  Bootstrap Icons v1.11.1 (font/fonts/), MIT License, https://icons.getbootstrap.com/

All other files (PHP templates, assets/css, assets/js, theme.json, languages) are original work of
the theme author, licensed under GPLv2 or later.

== Credits ==

* Theme author: eRui.org (https://eRui.org)
* Bootstrap 5.3.2 — https://getbootstrap.com/ — MIT License (see Copyright and Resources)
* Bootstrap Icons 1.11.1 — https://icons.getbootstrap.com/ — MIT License (see Copyright and Resources)
* screenshot.png — self-made by the theme author from a fresh WordPress install with WordPress's
  default sample content ("Hello world!"). Icons in it are Bootstrap Icons (MIT); the small avatar
  is the Gravatar of the test administrator account.
* Bundled under GPLv2 or later, consistent with WordPress licensing.
