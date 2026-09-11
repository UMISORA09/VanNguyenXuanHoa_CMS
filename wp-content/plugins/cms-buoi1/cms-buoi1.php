<?php
/**
 * Plugin Name: CMS Buoi 1
 * Description: Plugin giải quyết các yêu cầu CRUD, Phân quyền, Categories và Video meta box.
 * Version: 1.0
 * Author: Văn Nguyễn Xuân Hòa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// 1. Phân quyền cho user
function cms_buoi1_add_roles() {
    // Role: cms_read
    add_role(
        'cms_read',
        'CMS Read',
        array(
            'read' => true,
        )
    );

    // Role: cms_write
    add_role(
        'cms_write',
        'CMS Write',
        array(
            'read' => true,
            'edit_posts' => true,
            'publish_posts' => true,
            'edit_published_posts' => true,
            'delete_posts' => true,
            'upload_files' => true, // Thêm quyền upload file để post bài có hình ảnh
        )
    );

    // Role: cms_admin
    // Lưu ý: Để cài theme/plugin, thường cần thêm các quyền liên quan và đôi khi cả manage_options
    add_role(
        'cms_admin',
        'CMS Admin',
        array(
            'read' => true,
            'install_plugins' => true,
            'activate_plugins' => true,
            'install_themes' => true,
            'switch_themes' => true,
            'update_plugins' => true,
            'delete_plugins' => true,
            'update_themes' => true,
            'delete_themes' => true,
            'manage_options' => true, // Cần thiết để truy cập admin dashboard trọn vẹn
        )
    );
}

// 2. Tạo Custom Post Type "Thể thao" và Custom Taxonomy
function cms_buoi1_register_post_type() {
    register_post_type('the-thao', array(
        'labels' => array(
            'name' => 'Thể thao',
            'singular_name' => 'Bài viết Thể thao',
            'add_new' => 'Thêm bài mới',
            'add_new_item' => 'Thêm Bài viết Thể thao mới',
            'edit_item' => 'Sửa Bài viết',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-volleyball',
    ));

    register_taxonomy('the-thao-category', 'the-thao', array(
        'labels' => array(
            'name' => 'Danh mục Thể thao',
            'singular_name' => 'Danh mục',
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'cms_buoi1_register_post_type');

// 3. Tạo category mặc định cho Thể thao
function cms_buoi1_add_categories() {
    $categories = array('Tennis', 'Pic', 'Football');
    foreach ($categories as $cat_name) {
        if (!term_exists($cat_name, 'the-thao-category')) {
            wp_insert_term(
                $cat_name,
                'the-thao-category'
            );
        }
    }
}

// Chạy khi kích hoạt plugin
register_activation_hook(__FILE__, 'cms_buoi1_activate');
function cms_buoi1_activate() {
    cms_buoi1_add_roles();
    cms_buoi1_register_post_type();
    cms_buoi1_add_categories();
    flush_rewrite_rules(); // Xoá cache đường dẫn để CPT hoạt động
}

// Bật tính năng Featured Image (Hình ảnh đại diện) cho các bài viết
function cms_buoi1_theme_setup() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'cms_buoi1_theme_setup');

// 4. Xử lý "Hình ảnh" và "Video (YouTube)" cho Post (thể thao)
function cms_buoi1_add_video_meta_box() {
    add_meta_box(
        'cms_buoi1_video_id',
        'Video (YouTube)',
        'cms_buoi1_video_meta_box_html',
        'the-thao', // Đổi sang hiển thị ở CPT Thể thao
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'cms_buoi1_add_video_meta_box');

function cms_buoi1_video_meta_box_html($post) {
    $value = get_post_meta($post->ID, '_cms_buoi1_video_url', true);
    ?>
    <label for="cms_buoi1_video_url">Đường dẫn Video YouTube:</label>
    <input type="url" name="cms_buoi1_video_url" id="cms_buoi1_video_url" class="large-text" value="<?php echo esc_attr($value); ?>" placeholder="https://www.youtube.com/watch?v=...">
    <?php
}

function cms_buoi1_save_video_postdata($post_id) {
    if (array_key_exists('cms_buoi1_video_url', $_POST)) {
        update_post_meta(
            $post_id,
            '_cms_buoi1_video_url',
            sanitize_text_field($_POST['cms_buoi1_video_url'])
        );
    }
}
add_action('save_post', 'cms_buoi1_save_video_postdata');

// 5. Hàm trích xuất và hiển thị iframe YouTube trực tiếp (tránh lỗi oEmbed trên môi trường local)
function cms_buoi1_get_youtube_iframe($video_url) {
    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $video_url, $matches)) {
        $video_id = esc_attr($matches[1]);
        return '<div class="cms-buoi1-video-wrapper" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.15);margin:20px 0;">'
             . '<iframe src="https://www.youtube.com/embed/' . $video_id . '" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
             . '</div>';
    }
    return '';
}

// 6. Hiển thị Video ra ngoài trang chủ / trang chi tiết bài viết
function cms_buoi1_display_video_in_post($content) {
    if (is_singular('the-thao') || is_single()) {
        $video_url = get_post_meta(get_the_ID(), '_cms_buoi1_video_url', true);
        if (!empty($video_url)) {
            $iframe = cms_buoi1_get_youtube_iframe($video_url);
            if ($iframe) {
                $content .= '<div class="cms-buoi1-video" style="margin-top: 35px;border-top:2px dashed #ddd;padding-top:20px;"><h3 style="color:#1d2327;">🎬 Video Highlight Trận Đấu Đỉnh Cao:</h3>' . $iframe . '</div>';
            }
        }
    }
    return $content;
}
add_filter('the_content', 'cms_buoi1_display_video_in_post');
