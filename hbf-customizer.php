<?php
/**
 * Plugin Name: HBF Customizer
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) exit;
define('HBF_PATH', plugin_dir_path(__FILE__));

// Nạp các file chứa hàm xử lý TRƯỚC
require_once HBF_PATH . 'includes/header-functions.php';
require_once HBF_PATH . 'includes/body-functions.php';
require_once HBF_PATH . 'includes/footer-functions.php';
require_once HBF_PATH . 'includes/settings-functions.php';
require_once HBF_PATH . 'shortcode/header1-shortcode.php';
require_once HBF_PATH . 'shortcode/body2-shortcode.php';
require_once HBF_PATH . 'shortcode/header2-shortcode.php';
// Sau đó mới nạp file Menu Admin
require_once HBF_PATH . 'includes/admin-menu.php';
/**
 * KÍCH HOẠT HỆ THỐNG CẬP NHẬT TỰ ĐỘNG TỪ GITHUB
 */
// 1. Xác định đường dẫn file thư viện dựa trên hằng số HBF_PATH
$puc_file = HBF_PATH . 'includes/plugin-update-checker/plugin-update-checker.php';

if ( file_exists( $puc_file ) ) {
    require_once $puc_file;
    
    // 2. Sử dụng PucFactory để khởi tạo trình kiểm tra cập nhật
    // Lưu ý: Đã đổi sang user 'trunglevillage' theo tài khoản của bạn
    $myUpdateChecker = YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
        'https://github.com/trunglevillage/hbf-customizer/', 
        __FILE__, 
        'hbf-customizer'
    );

    // 3. Thiết lập nhánh kiểm tra là 'main'
    if ( method_exists( $myUpdateChecker, 'setBranch' ) ) {
        $myUpdateChecker->setBranch('main');
    }

    // 4. (Tùy chọn) Ép buộc kiểm tra cập nhật ngay lập tức nếu cần (chỉ dùng khi debug)
    // $myUpdateChecker->getUpdate();
}