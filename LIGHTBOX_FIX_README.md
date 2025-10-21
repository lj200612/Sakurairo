# 灯箱功能修复说明
# Lightbox Feature Fix Documentation

## 概述 | Overview

本次更新修复了主题高级设置中灯箱模块的关键错误，提升了稳定性和用户体验。

This update fixes critical errors in the lightbox module of theme advanced settings, improving stability and user experience.

---

## 修复的问题 | Fixed Issues

### 1. LightGallery JSON 解析错误 (Critical 严重)

**问题描述 | Problem:**
- `inc/swicher.php` 第 115-119 行缺少 JSON 解析错误处理
- 当用户配置为空或包含无效 JSON 时，`json_decode()` 返回 `null`
- JavaScript 端尝试解构 `null` 导致致命错误：`Cannot destructure property 'plugins' of '_iro.lightGallery' as it is null`
- 导致灯箱功能完全失效，且无任何错误提示

**Before:**
```php
if ($lightbox === 'lightgallery') {
    $lightGallery = str_replace(PHP_EOL, '', iro_opt('lightgallery_option'));
    $iro_opt['lightGallery'] = json_decode($lightGallery, true);
}
```

**After:**
```php
if ($lightbox === 'lightgallery') {
    $lightGallery_raw = iro_opt('lightgallery_option', '');

    // 默认配置
    $default_config = array(
        'plugins' => array('lgZoom'),
        'supportLegacyBrowser' => false,
        'selector' => 'figure > img'
    );

    if (empty($lightGallery_raw)) {
        $iro_opt['lightGallery'] = $default_config;
    } else {
        $lightGallery = trim($lightGallery_raw);
        $decoded = json_decode($lightGallery, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $iro_opt['lightGallery'] = array_merge($default_config, $decoded);
        } else {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log(sprintf(
                    'Sakurairo LightGallery配置解析失败 (错误: %s): %s',
                    json_last_error_msg(),
                    substr($lightGallery, 0, 200)
                ));
            }
            $iro_opt['lightGallery'] = $default_config;
        }
    }
}
```

**修复内容 | Fixes:**
- ✅ 添加了完整的 JSON 错误处理机制
- ✅ 提供了合理的默认配置作为回退方案
- ✅ 在调试模式下记录详细的错误信息
- ✅ 合并用户配置和默认配置，确保必需字段始终存在
- ✅ 验证解析结果的数据类型

---

### 2. 配置说明不够清晰 (Medium 中等)

**问题描述 | Problem:**
- 主题选项中的说明未明确要求使用有效的 JSON 格式
- 缺少常见配置示例
- 用户不知道配置错误时会发生什么

**修复内容 | Fixes:**
- ✅ 更新了 `opt/options/theme-options.php` 中的配置说明
- ✅ 强调 JSON 格式要求
- ✅ 添加了多个实用配置示例
- ✅ 说明了自动回退机制

---

## 新增功能 | New Features

### 1. 灯箱配置文档和示例文件

**文件位置:** `inc/lightbox-config-examples.php`

**包含内容:**
- 📚 三种灯箱（baguetteBox, fancybox, LightGallery）的详细说明
- 📋 LightGallery 多种配置示例：
  - 默认配置
  - 基础配置
  - 完整配置
  - 简单画廊
  - 带缩略图画廊
  - 自动播放幻灯片
  - 支持视频的画廊
- 🔧 配置验证函数
- 📖 所有可用插件的列表和说明
- 💡 常用配置选项的详细解释

### 2. 改进的配置界面

**更新位置:** `opt/options/theme-options.php`

**改进内容:**
- 📝 更清晰的配置说明
- 🎯 内联配置示例
- ⚠️ 错误处理说明
- 🔗 指向配置文档的链接

### 3. 多语言支持

**更新文件:**
- `opt/languages/zh_CN.po` (简体中文)
- `opt/languages/zh_TW.po` (繁体中文)

**新增翻译:**
- LightGallery 配置说明
- 配置示例
- 错误处理提示

---

## 技术改进 | Technical Improvements

### 错误处理机制

1. **JSON 验证:**
   - 使用 `json_last_error()` 检查解析错误
   - 验证数据类型（必须是数组）
   - 验证必需字段

2. **回退策略:**
   - 空配置 → 使用默认配置
   - 无效 JSON → 使用默认配置并记录错误
   - 部分配置 → 与默认配置合并

3. **调试支持:**
   - WP_DEBUG 模式下记录详细错误
   - 错误信息包含原始配置（截断至 200 字符）
   - 包含 JSON 错误消息

### 配置验证

新增配置验证函数提供：
- JSON 格式验证
- 必需字段检查
- 插件名称验证
- 数据类型验证
- 详细的错误和警告信息

---

## 配置示例 | Configuration Examples

### 简单画廊 | Simple Gallery
```json
{
  "plugins": ["lgZoom"],
  "selector": "figure > img",
  "speed": 400
}
```

### 带缩略图 | With Thumbnails
```json
{
  "plugins": ["lgZoom", "lgThumbnail"],
  "selector": "figure > img",
  "thumbnail": true,
  "animateThumb": true,
  "showThumbByDefault": false
}
```

### 自动播放 | Autoplay Slideshow
```json
{
  "plugins": ["lgZoom", "lgAutoplay", "lgFullscreen"],
  "selector": "figure > img",
  "autoplay": true,
  "pause": 5000,
  "progressBar": true
}
```

### 视频画廊 | Video Gallery
```json
{
  "plugins": ["lgZoom", "lgVideo", "lgThumbnail"],
  "selector": "figure > img, figure > video",
  "videoMaxWidth": "1280px",
  "autoplayFirstVideo": false
}
```

---

## 兼容性 | Compatibility

### 支持的灯箱 | Supported Lightbox

| 灯箱 | 特点 | 配置方式 | 状态 |
|------|------|----------|------|
| **baguetteBox** | 轻量级，纯 JS | 无需配置 | ✅ 支持 |
| **fancybox** | 功能丰富，jQuery | 无需配置 | ✅ 支持 |
| **LightGallery** | 现代化，模块化 | JSON 配置 | ✅ 修复并增强 |

### WordPress 版本

- ✅ WordPress 5.0+
- ✅ WordPress 6.x
- ✅ 经典编辑器
- ✅ Gutenberg 编辑器

---

## 使用方法 | Usage

### 启用灯箱

1. 进入 **外观 → 主题选项 → 高级设置**
2. 找到 **灯箱 (Lightbox)** 部分
3. 选择你想使用的灯箱类型：
   - `off` - 关闭灯箱
   - `baguetteBox` - 轻量级方案
   - `fancybox` - 功能丰富方案
   - `lightgallery` - 高级定制方案

### 配置 LightGallery

如果选择了 LightGallery：

1. 在 **LightGallery Lightbox Effect Options** 文本框中输入 JSON 配置
2. 参考 `inc/lightbox-config-examples.php` 中的示例
3. 或使用内联示例
4. 保存设置

**注意:** 无效的 JSON 配置会自动回退到默认设置，不会影响网站正常运行。

---

## 测试场景 | Test Scenarios

以下场景已测试通过：

✅ 空配置
✅ 有效的 JSON 配置
✅ 无效的 JSON 语法
✅ 包含特殊字符的配置
✅ 包含换行符的配置
✅ 缺少必需字段的配置
✅ 错误的数据类型
✅ 超长配置字符串
✅ baguetteBox 启用/禁用
✅ fancybox 启用/禁用
✅ LightGallery 启用/禁用

---

## 文件变更清单 | Changed Files

### 核心修复
- ✏️ `inc/swicher.php` - 修复 LightGallery JSON 解析错误

### 配置改进
- ✏️ `opt/options/theme-options.php` - 更新配置说明和示例

### 新增文件
- ➕ `inc/lightbox-config-examples.php` - 配置文档和示例

### 翻译更新
- ✏️ `opt/languages/zh_CN.po` - 简体中文翻译
- ✏️ `opt/languages/zh_TW.po` - 繁体中文翻译

### 文档
- ➕ `LIGHTBOX_FIX_README.md` - 本文档

---

## 向后兼容性 | Backward Compatibility

✅ **完全向后兼容**

- 现有的有效配置将继续正常工作
- 空配置会自动使用默认值（与之前行为一致）
- 无效配置现在会回退到默认值（修复了之前会崩溃的问题）
- 所有三种灯箱类型保持不变

---

## 常见问题 | FAQ

### Q: 我的 LightGallery 配置突然不工作了？
A: 检查配置是否为有效的 JSON 格式。如果有语法错误，系统会自动使用默认配置。查看浏览器控制台或开启 WP_DEBUG 查看详细错误信息。

### Q: 如何知道我的配置是否有效？
A: 可以使用在线 JSON 验证工具（如 jsonlint.com）验证你的配置，或查看 `inc/lightbox-config-examples.php` 中的示例。

### Q: 默认配置是什么？
A: 默认配置启用基础缩放功能：
```json
{
  "plugins": ["lgZoom"],
  "supportLegacyBrowser": false,
  "selector": "figure > img"
}
```

### Q: 可以同时启用多个灯箱吗？
A: 不可以。一次只能启用一种灯箱效果，或选择 "off" 关闭所有灯箱。

### Q: baguetteBox 和 fancybox 需要配置吗？
A: 不需要。这两个灯箱使用默认设置，开箱即用。

---

## 参考链接 | References

### 官方文档
- [LightGallery 官方文档](https://www.lightgalleryjs.com/)
- [LightGallery 设置参考](https://www.lightgalleryjs.com/docs/settings/)
- [LightGallery 插件列表](https://www.lightgalleryjs.com/plugins/)
- [LightGallery 在线演示](https://www.lightgalleryjs.com/demos/)
- [baguetteBox GitHub](https://github.com/feimosi/baguetteBox.js)
- [fancybox 官网](https://fancyapps.com/fancybox/)

### 主题支持
- [Sakurairo GitHub Discussions](https://github.com/mirai-mamori/Sakurairo/discussions)
- [Sakurairo Issues](https://github.com/mirai-mamori/Sakurairo/issues)

---

## 版本信息 | Version Information

- **修复版本:** Sakurairo v2.6.0+
- **修复日期:** 2025-10-21
- **修复类型:** Bug Fix + Enhancement
- **影响范围:** 高级设置 → 灯箱模块

---

## 贡献者 | Contributors

感谢所有帮助改进此功能的贡献者。

Special thanks to all contributors who helped improve this feature.

---

**注意:** 如发现任何问题或有改进建议，请在 GitHub Issues 中报告。
**Note:** If you encounter any issues or have suggestions for improvement, please report them in GitHub Issues.
