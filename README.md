# Prism — 棱镜折射多彩光芒

基于 **Bootstrap 5** 的现代 WordPress 博客主题，紫蓝渐变风格，响应式设计。

![Theme Version](https://img.shields.io/badge/version-1.1.0-667eea)
![Requires PHP](https://img.shields.io/badge/PHP-7.4%2B-764ba2)
![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-21759b)
![License](https://img.shields.io/badge/license-GPL--2.0--or--later-blue)
![CDN Free](https://img.shields.io/badge/CDN-not%20required-success)

## 特性

- 🎨 紫蓝渐变现代设计，Bootstrap 5 响应式布局
- 🎛️ **Customizer 可视化设置**：首页 Hero 标题/副标题、Hero 风格（渐变 / 纯色深灰）实时预览
- 🏠 首页特色文章 + 双列文章网格，无特色图的文章自动去除图片位
- 📂 分类侧边栏，支持为每个分类自定义图标（40+ Bootstrap Icons 可选）
- 🏷️ 标签云、热门文章（按浏览量排序）、站内搜索
- 👁️ 文章浏览量统计（排除爬虫与重复刷新），中英文混排智能阅读时长估算
- 💬 Bootstrap 卡片式评论模板（支持嵌套回复），兼容 Jetpack / Mailchimp 订阅
- 🍔 移动端折叠导航，桌面端自定义菜单 + 自定义 Logo
- 🧱 支持 Gutenberg：自定义调色板、渐变、宽屏对齐、`theme.json` 排版控制
- ♿ 无障碍：skip-link、`<main>` landmark、导航 aria-label、焦点样式
- 📦 **零外部依赖**：Bootstrap 与图标全部内置在 `assets/vendor/`，不依赖 CDN
- 🌐 内置简体中文语言包（121 条字符串已完整翻译），翻译就绪（Text Domain: `prism`）

## Changelog

### 1.1.0

- 新增 Customizer「首页 Hero」面板，标题/副标题/风格可后台修改并实时预览
- 分页改为 Bootstrap 5 结构，新增 `prism_pagination()` 辅助函数
- 评论列表改用自定义回调，多条 CSS 规则此前因模板未输出类名而失效，现已生效
- 所有正文容器改用 `<article>` + `post_class()`，`.sticky` 置顶标识生效
- 新增 `searchform.php`，搜索框与主题风格统一
- 补齐 `$content_width`、`theme.json`、`add_editor_style()`、`add_image_size()`
- 文章卡片与 Hero 抽取为 `template-parts/`，消除三处重复 HTML
- 浏览量统计改挂 `wp` 钩子，排除预览/Feed/爬虫，同一 IP 一小时内去重
- Bootstrap 资源本地化，不再依赖 CDN
- 语言包补全至 121 条

### 1.0.0

- 首个正式版

## 安装

1. 下载 ZIP 并解压（或将本仓库克隆）到 `wp-content/themes/` 目录；
2. 进入 WordPress 后台 → 外观 → 主题，启用 **Prism**；
3. （可选）后台 → 外观 → 菜单，设置「主菜单」和「页脚菜单」；
4. （可选）文章 → 分类 → 编辑分类，为分类选择一个图标。

## 目录结构

```
prism-theme/
├── assets/
│   ├── css/
│   │   ├── custom.css         # 附加样式
│   │   └── editor-style.css   # 古腾堡编辑器样式
│   ├── js/
│   │   ├── main.js            # 前端脚本
│   │   └── customizer.js      # Customizer 实时预览
│   ├── vendor/                # 内置 Bootstrap 5 + Bootstrap Icons（无需 CDN）
│   │   ├── bootstrap/{css,js}
│   │   └── bootstrap-icons/
├── languages/                 # 语言包（zh_CN）
├── template-parts/
│   ├── hero.php               # 首页 Hero 区
│   └── content-card.php       # 文章卡片（列表/网格通用）
├── theme.json                 # 编辑器全局样式配置
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── screenshot.png
├── search.php
├── searchform.php
├── sidebar.php
├── single.php
└── style.css
```

## 自定义

- 首页文案与风格：后台 → 外观 → 自定义 → **Home Hero**（标题、副标题、渐变/纯色深灰）
- 分类图标：后台 → 文章 → 分类 → 编辑，选择图标（未设置时按分类 ID 自动分配）
- 侧边栏 / 底部组件：后台 → 外观 → 小工具
- 主菜单 / 页脚菜单：后台 → 外观 → 菜单
- 想改回 CDN 加载资源，在子主题中加入：`add_filter('prism_use_local_assets', '__return_false');`

## 许可证

GPL-2.0-or-later。基于 [Bootstrap](https://getbootstrap.com)（MIT License）与 [Bootstrap Icons](https://icons.getbootstrap.com)（MIT License）构建。

---

Theme by [eRui.org](https://eRui.org)
