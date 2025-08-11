<?php
// Prevent direct access to this file for security
if (!defined('ABSPATH')) exit;

// Theme setup function
function mytheme_setup() {
    add_theme_support('title-tag'); // Let WordPress handle the <title> tag
    add_theme_support('post-thumbnails'); // Enable featured images
    register_nav_menus([
        'primary' => __('Primary Menu', 'mytheme'), // Register primary navigation menu
    ]);
}
add_action('after_setup_theme', 'mytheme_setup'); // Run setup after theme loads

// Enqueue stylesheets
function mytheme_scripts() {
    wp_enqueue_style('mytheme-style', get_stylesheet_uri()); // Load the main style.css
}
add_action('wp_enqueue_scripts', 'mytheme_scripts'); // Attach styles when scripts are loaded

// Register the "Projects" Custom Post Type
function mytheme_register_projects_cpt() {
    $labels = [
        'name' => 'Projects', // Plural name
        'singular_name' => 'Project', // Singular name
    ];
    $args = [
        'labels' => $labels,
        'public' => true, // Publicly visible
        'menu_position' => 5, // Menu position in dashboard
        'supports' => ['title', 'editor', 'thumbnail'], // Features supported
        'has_archive' => true, // Enable archive page
        'rewrite' => ['slug' => 'projects'], // URL slug
    ];
    register_post_type('project', $args); // Register the CPT
}
add_action('init', 'mytheme_register_projects_cpt'); // Register CPT on init

// Add meta boxes for additional project details
function mytheme_add_project_meta_boxes() {
    add_meta_box('project_details', 'Project Details', 'mytheme_project_meta_box_html', 'project', 'normal', 'high');
}
add_action('add_meta_boxes', 'mytheme_add_project_meta_boxes'); // Add meta boxes when editing posts

// Meta Box HTML form fields
function mytheme_project_meta_box_html($post) {
    wp_nonce_field('mytheme_save_project_meta', 'mytheme_project_meta_nonce'); // Security nonce

    // Get existing meta values
    $start_date = get_post_meta($post->ID, 'project_start_date', true);
    $end_date = get_post_meta($post->ID, 'project_end_date', true);
    $description = get_post_meta($post->ID, 'project_description', true);
    $url = get_post_meta($post->ID, 'project_url', true);
    ?>
    <p>
        <label>Start Date:</label><br>
        <input type="date" name="project_start_date" value="<?php echo esc_attr($start_date); ?>">
    </p>
    <p>
        <label>End Date:</label><br>
        <input type="date" name="project_end_date" value="<?php echo esc_attr($end_date); ?>">
    </p>
    <p>
        <label>Description:</label><br>
        <textarea name="project_description" rows="4" style="width:100%;"><?php echo esc_textarea($description); ?></textarea>
    </p>
    <p>
        <label>Project URL:</label><br>
        <input type="url" name="project_url" value="<?php echo esc_attr($url); ?>">
    </p>
    <?php
}

// Save meta box data securely when the project is saved
function mytheme_save_project_meta($post_id) {
    // Verify nonce to secure form submission
    if (!isset($_POST['mytheme_project_meta_nonce']) ||
        !wp_verify_nonce($_POST['mytheme_project_meta_nonce'], 'mytheme_save_project_meta')) {
        return;
    }
    // Prevent auto-save from overwriting values
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) return;

    // Save and sanitize each field if set
    if (isset($_POST['project_start_date'])) {
        update_post_meta($post_id, 'project_start_date', sanitize_text_field($_POST['project_start_date']));
    }
    if (isset($_POST['project_end_date'])) {
        update_post_meta($post_id, 'project_end_date', sanitize_text_field($_POST['project_end_date']));
    }
    if (isset($_POST['project_description'])) {
        update_post_meta($post_id, 'project_description', sanitize_textarea_field($_POST['project_description']));
    }
    if (isset($_POST['project_url'])) {
        update_post_meta($post_id, 'project_url', esc_url_raw($_POST['project_url']));
    }
}
add_action('save_post', 'mytheme_save_project_meta'); // Save custom fields when a post is saved
