<?php
/**
 * Sakurairo 灯箱配置示例和帮助文档
 * Lightbox Configuration Examples and Documentation
 *
 * 本文件提供了三种灯箱效果的配置说明和示例
 * This file provides configuration instructions and examples for three lightbox effects
 *
 * @package Sakurairo
 * @since 2.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * ============================================
 * 1. baguetteBox 配置
 * ============================================
 *
 * baguetteBox 是一个轻量级的纯JavaScript图片灯箱
 * baguetteBox is a lightweight pure JavaScript image lightbox
 *
 * 特点：
 * - 轻量级，无依赖
 * - 支持触摸滑动
 * - 响应式设计
 *
 * 使用方法：
 * 在主题选项 -> 高级设置 -> 灯箱 中选择 "baguetteBox"
 *
 * 官方文档: https://github.com/feimosi/baguetteBox.js
 */

/**
 * ============================================
 * 2. fancybox 配置
 * ============================================
 *
 * Fancybox 是一个功能强大的jQuery灯箱插件
 * Fancybox is a powerful jQuery lightbox plugin
 *
 * 特点：
 * - 功能丰富
 * - 支持视频、iframe等多种内容
 * - 高度可定制
 *
 * 使用方法：
 * 在主题选项 -> 高级设置 -> 灯箱 中选择 "fancybox"
 *
 * 注意: 需要加载jQuery库
 * Note: Requires jQuery library
 *
 * 官方文档: https://fancyapps.com/fancybox/
 */

/**
 * ============================================
 * 3. LightGallery 配置示例
 * ============================================
 *
 * LightGallery 是一个功能全面的现代化灯箱组件
 * LightGallery is a feature-rich modern lightbox component
 *
 * 特点：
 * - 模块化设计
 * - 支持视频、iframe、HTML等多种内容
 * - 丰富的插件系统
 * - 触摸友好
 *
 * 官方文档: https://www.lightgalleryjs.com/
 * 插件列表: https://www.lightgalleryjs.com/plugins/
 */

/**
 * LightGallery 默认配置
 * 这是最基础的配置，启用缩放功能
 */
function get_lightgallery_default_config() {
    return array(
        'plugins' => array('lgZoom'),
        'supportLegacyBrowser' => false,
        'selector' => 'figure > img'
    );
}

/**
 * LightGallery 基础配置示例
 * 包含常用的基本功能
 */
function get_lightgallery_basic_config() {
    return array(
        'plugins' => array('lgZoom', 'lgThumbnail'),
        'supportLegacyBrowser' => false,
        'selector' => 'figure > img',
        'speed' => 500,
        'licenseKey' => '0000-0000-000-0000'
    );
}

/**
 * LightGallery 完整配置示例
 * 包含多个插件和高级设置
 *
 * 在主题后台的 LightGallery 配置框中粘贴以下JSON：
 */
function get_lightgallery_full_config_json() {
    return '{
  "plugins": ["lgZoom", "lgThumbnail", "lgHash", "lgAutoplay", "lgFullscreen"],
  "supportLegacyBrowser": false,
  "selector": "figure > img",
  "speed": 500,
  "licenseKey": "0000-0000-000-0000",
  "mode": "lg-fade",
  "loop": true,
  "download": true,
  "counter": true,
  "thumbnail": true,
  "animateThumb": true,
  "showThumbByDefault": false,
  "thumbWidth": 100,
  "thumbHeight": "80px",
  "thumbMargin": 5
}';
}

/**
 * LightGallery 可用插件列表
 *
 * 核心插件:
 * - lgZoom: 缩放功能
 * - lgThumbnail: 缩略图
 * - lgAutoplay: 自动播放
 * - lgFullscreen: 全屏模式
 * - lgHash: URL哈希支持
 * - lgPager: 分页器
 * - lgRotate: 旋转功能
 * - lgShare: 分享功能
 * - lgVideo: 视频支持
 * - lgComment: 评论支持
 * - lgMediumZoom: 中等缩放
 *
 * 使用方法：
 * 在 "plugins" 数组中添加你需要的插件名称
 *
 * 示例:
 * "plugins": ["lgZoom", "lgThumbnail", "lgFullscreen"]
 */

/**
 * LightGallery 常用配置选项说明
 *
 * 基础选项:
 * - mode: 过渡效果 ('lg-slide', 'lg-fade', 'lg-zoom-in', 'lg-zoom-out')
 * - speed: 动画速度(毫秒)，默认 400
 * - loop: 是否循环，默认 true
 * - download: 是否显示下载按钮，默认 true
 * - counter: 是否显示计数器，默认 true
 * - selector: CSS选择器，默认 'figure > img'
 *
 * 缩略图选项:
 * - thumbnail: 是否启用缩略图，默认 false
 * - animateThumb: 缩略图动画，默认 true
 * - showThumbByDefault: 默认显示缩略图，默认 false
 * - thumbWidth: 缩略图宽度，默认 100
 * - thumbHeight: 缩略图高度，默认 '80px'
 * - thumbMargin: 缩略图间距，默认 5
 *
 * 自动播放选项:
 * - autoplay: 是否自动播放，默认 false
 * - pause: 自动播放间隔(毫秒)，默认 5000
 * - progressBar: 是否显示进度条，默认 true
 *
 * 缩放选项:
 * - zoom: 是否启用缩放，默认 true
 * - scale: 缩放比例，默认 1
 * - actualSize: 是否有实际大小按钮，默认 true
 *
 * 视频选项:
 * - videoMaxWidth: 视频最大宽度，默认 '855px'
 * - autoplayFirstVideo: 自动播放第一个视频，默认 true
 * - youtubePlayerParams: YouTube播放器参数
 * - vimeoPlayerParams: Vimeo播放器参数
 */

/**
 * 配置验证函数
 * 验证LightGallery配置是否有效
 *
 * @param string $config_json JSON格式的配置字符串
 * @return array 包含验证结果和错误信息的数组
 */
function validate_lightgallery_config($config_json) {
    $result = array(
        'valid' => false,
        'errors' => array(),
        'warnings' => array()
    );

    // 检查是否为空
    if (empty($config_json)) {
        $result['errors'][] = '配置不能为空';
        return $result;
    }

    // 尝试解析JSON
    $decoded = json_decode($config_json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        $result['errors'][] = 'JSON格式错误: ' . json_last_error_msg();
        return $result;
    }

    // 检查是否为数组
    if (!is_array($decoded)) {
        $result['errors'][] = '配置必须是一个JSON对象';
        return $result;
    }

    // 检查必需的字段
    $required_fields = array('plugins', 'selector');
    foreach ($required_fields as $field) {
        if (!isset($decoded[$field])) {
            $result['warnings'][] = "建议包含 '{$field}' 字段";
        }
    }

    // 验证 plugins 数组
    if (isset($decoded['plugins'])) {
        if (!is_array($decoded['plugins'])) {
            $result['errors'][] = 'plugins 必须是一个数组';
            return $result;
        }

        // 检查插件名称格式
        $valid_plugins = array(
            'lgZoom', 'lgThumbnail', 'lgAutoplay', 'lgFullscreen',
            'lgHash', 'lgPager', 'lgRotate', 'lgShare', 'lgVideo',
            'lgComment', 'lgMediumZoom'
        );

        foreach ($decoded['plugins'] as $plugin) {
            if (!in_array($plugin, $valid_plugins)) {
                $result['warnings'][] = "未知的插件: {$plugin}";
            }
        }
    }

    // 验证 selector
    if (isset($decoded['selector']) && !is_string($decoded['selector'])) {
        $result['errors'][] = 'selector 必须是一个字符串';
        return $result;
    }

    // 如果没有错误，标记为有效
    if (empty($result['errors'])) {
        $result['valid'] = true;
    }

    return $result;
}

/**
 * 获取安全的LightGallery配置
 * 包含错误处理和默认值回退
 *
 * @param string $user_config 用户提供的配置
 * @return array 安全的配置数组
 */
function get_safe_lightgallery_config($user_config = '') {
    $default_config = get_lightgallery_default_config();

    if (empty($user_config)) {
        return $default_config;
    }

    $decoded = json_decode($user_config, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
        // 记录错误（仅在调试模式下）
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('LightGallery配置解析失败: ' . json_last_error_msg());
        }
        return $default_config;
    }

    // 合并用户配置和默认配置
    return array_merge($default_config, $decoded);
}

/**
 * 配置示例 - 适用于不同场景
 */

// 简单图片画廊
function get_simple_gallery_config() {
    return '{
  "plugins": ["lgZoom"],
  "selector": "figure > img",
  "speed": 400
}';
}

// 带缩略图的画廊
function get_thumbnail_gallery_config() {
    return '{
  "plugins": ["lgZoom", "lgThumbnail"],
  "selector": "figure > img",
  "thumbnail": true,
  "animateThumb": true,
  "showThumbByDefault": false
}';
}

// 自动播放幻灯片
function get_slideshow_config() {
    return '{
  "plugins": ["lgZoom", "lgAutoplay", "lgFullscreen"],
  "selector": "figure > img",
  "autoplay": true,
  "pause": 5000,
  "progressBar": true
}';
}

// 支持视频的画廊
function get_video_gallery_config() {
    return '{
  "plugins": ["lgZoom", "lgVideo", "lgThumbnail"],
  "selector": "figure > img, figure > video",
  "videoMaxWidth": "1280px",
  "autoplayFirstVideo": false
}';
}

/**
 * 打印配置帮助信息
 * 可在WordPress后台使用
 */
function print_lightgallery_help() {
    ?>
    <div class="lightgallery-help">
        <h3>LightGallery 配置帮助</h3>

        <h4>基础配置示例：</h4>
        <pre><code><?php echo esc_html(get_simple_gallery_config()); ?></code></pre>

        <h4>带缩略图配置：</h4>
        <pre><code><?php echo esc_html(get_thumbnail_gallery_config()); ?></code></pre>

        <h4>自动播放配置：</h4>
        <pre><code><?php echo esc_html(get_slideshow_config()); ?></code></pre>

        <h4>视频画廊配置：</h4>
        <pre><code><?php echo esc_html(get_video_gallery_config()); ?></code></pre>

        <p><strong>更多配置选项请访问:</strong></p>
        <ul>
            <li><a href="https://www.lightgalleryjs.com/docs/settings/" target="_blank">官方设置文档</a></li>
            <li><a href="https://www.lightgalleryjs.com/demos/" target="_blank">在线演示</a></li>
            <li><a href="https://www.lightgalleryjs.com/plugins/" target="_blank">插件列表</a></li>
        </ul>
    </div>
    <?php
}
