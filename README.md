# Zheshe（折射）— 棱镜折射多彩光芒

基于 **Bootstrap 5** 的现代 WordPress 博客主题，紫蓝渐变风格，响应式设计。

![Theme Version](https://img.shields.io/badge/version-1.4.7-667eea)
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
- 🌐 内置简体中文语言包（全部字符串已完整翻译），翻译就绪（Text Domain: `zheshe`）

## Changelog

### 1.4.7

WordPress.org 投稿合规补遗（承接 1.4.6）：

- **输出转义全面加固**：模板与小工具表单中 57 处 `_e()` 改为 `esc_html_e()`，直接拼接输出的
  `__()` 改为 `esc_html__()`；补齐搜索框 `value`、自定义 Logo 回退、归档标题、分类描述、
  日期、字符集、评论数等遗漏的转义
- **移除死代码**：删除 `assets/js/main.js` 中绑定不存在的 `.subscribe-form` 的订阅逻辑，
  以及其中不可翻译的硬编码中文
- **元数据与兼容性**：`style.css` 的 Description 改为英文（主题目录页展示）；补上
  `.alignleft` / `.alignright` / `.aligncenter` / `.wp-caption` / `.wp-caption-text` /
  `.gallery-caption` / `.bypostauthor` / `.screen-reader-text` 等 Core 样式类，
  并声明 `custom-background` 支持
- 不改变视觉、不新增可翻译字符串，语言包仍与源码同步（148 条）

### 1.4.6

WordPress.org 主题目录投稿前的合规整改：

- **主题不再替用户写入小工具**：删除启用主题 / 每次进后台时自动种入侧边栏的逻辑及
  `zheshe_sidebar_seeded` 选项；默认侧边栏布局改为 `starter-content`，仅在全新站点、
  用户于 Customizer 中主动发布时生效
- 旧浏览量键 `post_views` 的批量迁移不再挂 `admin_init`，只在有权限的用户启用主题时执行一次，
  不再写 `zheshe_views_migrated`；读取单篇浏览量时的惰性迁移保留
- 首页改用主循环：每页篇数跟随「设置 → 阅读」，置顶文章由 Core 处理（`.sticky`，不重复输出），
  `index.php` 与 `front-page.php` 共用新的 `template-parts/post-list.php`；静态首页先输出页面正文再输出文章列表
- 分类图标预览脚本改用 `wp_add_inline_script()` 输出（此前挂载的钩子永远不匹配，预览实际不生效）
- 模板中的内联 `style` 改为 CSS 工具类（`.zheshe-hero-icon`、`.zheshe-empty-icon`），
  评论头像尺寸改用 CSS 变量 `--zheshe-avatar-size`
- 「Zheshe: Search」小工具改走 `searchform.php`（`get_search_form()`），补齐隐藏 label，搜索框 ID 每页唯一
- 页脚署名文字可翻译；`filemtime()` 失败时资源版本号回退为主题版本号
- `theme.json` 增加字体预设，并关闭 Core 默认色板，编辑器内直接使用主题色板
- 元数据：`Tested up to` 改为主版本号格式 7.1（在 WordPress 7.1.5 上测试），移除已废弃的 `responsive-layout` 标签，语言包头部更新并重新提取
- `readme.txt` 补齐 Copyright / Resources / Credits / Upgrade Notice，删除过时的手动覆盖升级说明
- 新增打包脚本 `bin/build-zip.sh`

### 1.4.5

- 评论头像改为固定尺寸容器，2x srcset / 正文图片规则下也保持正圆
- 评论者名字恢复为链接（`comment_author_link()`）
- 侧边栏「近期评论」头像固定为圆形尺寸

### 1.4.4

- 修复带评论的文章侧边栏掉到底部：自定义评论回调阻止 Walker_Comment 输出多余的闭合 div
- 修复头像变形；评论表单回复标题不再 h3 嵌套 h5；div 风格评论的嵌套回复增加缩进

### 1.4.3

- 块编辑器添加的侧边栏小工具标题统一为主题标题样式
- 摘要去除行首 Markdown 符号（`##`、`>`）

### 1.4.2

- 主题 CSS/JS 以文件修改时间作为版本号，更新后缓存立即失效
- 不再单独提供覆盖包，统一使用 `zheshe.zip`

### 1.4.1

- 官方小工具（近期文章、分类、搜索、标签云、RSS、Meta）统一为主题卡片风格

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

启用后侧边栏默认为空，主题不会替你添加小工具：到「外观 → 小工具 → 博客侧边栏」自行添加；
全新站点也可以在「外观 → 自定义」中预览并发布主题提供的默认布局（starter content）。

## 打包

```sh
sh bin/build-zip.sh
```

在仓库根目录生成 `zheshe.zip`（顶层目录为 `zheshe/`），已排除 `.git/`、`bin/`、隐藏文件、
`node_modules/`、`*.zip`、`*.log` 等开发文件，可直接用于后台上传或提交到 WordPress.org。

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
├── bin/
│   └── build-zip.sh           # 打包脚本（不进入 zheshe.zip）
├── languages/                 # 语言包（zh_CN）
├── template-parts/
│   ├── hero.php               # 首页 Hero 区
│   ├── post-list.php          # 文章列表（index.php / front-page.php 共用）
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



