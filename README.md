# Zheshe（折射）— 棱镜折射多彩光芒

基于 **Bootstrap 5** 的现代 WordPress 博客主题，紫蓝渐变风格，响应式设计。

![Theme Version](https://img.shields.io/badge/version-1.4.0-667eea)
![Requires PHP](https://img.shields.io/badge/PHP-7.4%2B-764ba2)
![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-21759b)
![License](https://img.shields.io/badge/license-GPL--2.0--or--later-blue)
![CDN Free](https://img.shields.io/badge/CDN-not%20required-success)

## 特性

- 🧱 **侧边栏完全小工具化**：默认模块与「按钮链接」均为标准小工具，后台自由排序

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
- 🧩 **「按钮链接」小工具**：侧边栏一键添加十年之约、虫洞等跳转按钮
- 🌐 内置简体中文语言包（129 条字符串已完整翻译），翻译就绪（Text Domain: `zheshe`）

## Changelog

### 1.4.0

- **侧边栏完全小工具化**（官方规范）：默认模块全部变为真正的小工具——
  搜索 / 分类导航（带图标）/ 标签云 / 热门文章（按浏览量）/ 订阅更新
- 主题启用时自动为空的侧边栏种入默认布局；已配置的小工具不受影响，可自由增删排序

### 1.3.0

- 新增「按钮链接」小工具：每行一条 `名称|链接|图标` 生成一列跳转按钮，
  适合「十年之约」「虫洞」等博客圈外链；支持在新窗口打开
- **修复小工具区从未渲染的问题**：注册过的「博客侧边栏」「底部区域」现在真正可用，
  自定义组件会显示在侧边栏分类卡片上方与页脚栏之后
- 语言包扩充至 129 条

### 1.2.0

- **更名为 Zheshe**，主题目录名、Text Domain、函数前缀三者统一为 `zheshe`
- 数据库键名加前缀：`post_views` → `zheshe_post_views`、`blog_hero_*` → `zheshe_hero_*`，
  并自动迁移旧数据（升级不丢浏览量与 Hero 文案）
- 新增 `readme.txt`（WordPress.org 官方目录要求的格式）
- 语言包重新生成（补全 PO 头，121 条译文）

### 1.1.0

- 新增 Customizer「首页 Hero」面板，标题/副标题/风格可后台修改并实时预览
- 分页改为 Bootstrap 5 结构，新增 `zheshe_pagination()` 辅助函数
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

1. 下载 ZIP 并解压（或将本仓库克隆）到 `wp-content/themes/` 目录，确保主题文件夹名为 **`zheshe`**；
2. 进入 WordPress 后台 → 外观 → 主题，启用 **Zheshe**；
3. （可选）后台 → 外观 → 菜单，设置「主菜单」和「页脚菜单」；
4. （可选）文章 → 分类 → 编辑分类，为分类选择一个图标。

> **升级提示**：WordPress 后台「上传主题」只会全新安装、不会覆盖已有目录。
> 升级方式：下载 Release 里的 `zheshe.zip`，本地解压后把文件通过 FTP 覆盖到
> `wp-content/themes/zheshe/`，主题 slug 不变，Customizer 设置、菜单和小工具都会保留。
> 主题 CSS/JS 的链接自带文件时间戳版本号，覆盖后 Cloudflare/浏览器缓存会自动失效。

## 目录结构

```
zheshe/
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
- 想改回 CDN 加载资源，在子主题中加入：`add_filter('zheshe_use_local_assets', '__return_false');`

## 许可证

GPL-2.0-or-later。基于 [Bootstrap](https://getbootstrap.com)（MIT License）与 [Bootstrap Icons](https://icons.getbootstrap.com)（MIT License）构建。

---

Theme by [eRui.org](https://eRui.org)
