# Prism — 棱镜折射多彩光芒

基于 **Bootstrap 5** 的现代 WordPress 博客主题，紫蓝渐变风格，响应式设计。

![Theme Version](https://img.shields.io/badge/version-1.0.0-667eea)
![Requires PHP](https://img.shields.io/badge/PHP-7.4%2B-764ba2)
![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-21759b)
![License](https://img.shields.io/badge/license-GPL--2.0--or--later-blue)

## 特性

- 🎨 紫蓝渐变现代设计，Bootstrap 5 响应式布局
- 🏠 首页特色文章 + 双列文章网格，无特色图的文章自动去除图片位
- 📂 分类侧边栏，支持为每个分类自定义图标（40+ Bootstrap Icons 可选）
- 🏷️ 标签云、热门文章（按浏览量排序）、站内搜索
- 👁️ 文章浏览量统计，中英文混排智能阅读时长估算
- 💬 评论模板（支持嵌套回复），兼容 Jetpack / Mailchimp 订阅
- 🍔 移动端折叠导航，桌面端自定义菜单 + 自定义 Logo
- 🌐 内置简体中文语言包，翻译就绪（Text Domain: `prism`）

## 安装

1. 下载 ZIP 并解压（或将本仓库克隆）到 `wp-content/themes/` 目录；
2. 进入 WordPress 后台 → 外观 → 主题，启用 **Prism**；
3. （可选）后台 → 外观 → 菜单，设置「主菜单」和「页脚菜单」；
4. （可选）文章 → 分类 → 编辑分类，为分类选择一个图标。

## 目录结构

```
prism-theme/
├── assets/
│   ├── css/custom.css   # 附加样式
│   └── js/main.js       # 前端脚本
├── languages/           # 语言包（zh_CN）
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── search.php
├── sidebar.php
├── single.php
└── style.css
```

## 自定义

- 首页标语：后台 → 外观 → 自定义 → 首页选项（`blog_hero_title` / `blog_hero_subtitle`）
- 分类图标：后台 → 文章 → 分类 → 编辑，选择图标（自动按分类 ID 分配默认图标）
- 侧边栏 / 底部组件：后台 → 外观 → 小工具

## 许可证

GPL-2.0-or-later。基于 [Bootstrap](https://getbootstrap.com)（MIT License）与 [Bootstrap Icons](https://icons.getbootstrap.com)（MIT License）构建。

---

Theme by [eRui.org](https://eRui.org)
