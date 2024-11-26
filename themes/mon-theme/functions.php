<?php
function mon_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    register_nav_menus([
        'main_menu' => 'Menu Principal',
    ]);
}
add_action('after_setup_theme', 'mon_theme_setup');

function mon_theme_enqueue_styles() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_styles');

function mon_theme_optim() { 
    remove_action('wp_head', 'wp_oembed_add_host_js'); 
    remove_action('wp_print_styles', 'print_emoji_styles'); 
    remove_action('wp_head', 'print_emoji_detection_script', 7); 
    remove_filter('the_content', 'convert_smilies');

    remove_action('wp_json_server_before_serve', 'rest_api_default_headers');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'wp_resource_hints', 2);

    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
}

add_action('init', 'mon_theme_optim');

function mon_theme_customizer($wp_customize) {
    $wp_customize->add_section('mon_theme_colors', array(
        'title'    => __('Couleurs', 'mon-theme'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('mon_theme_primary_color', array(
        'default' => '#37a8ff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mon_theme_primary_color_control', array(
        'label'    => __('Couleur Primaire', 'mon-theme'),
        'section'  => 'mon_theme_colors',
        'settings' => 'mon_theme_primary_color',
    )));

    $wp_customize->add_setting('mon_theme_secondary_color', array(
        'default' => '#87bfff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mon_theme_secondary_color_control', array(
        'label'    => __('Couleur Secondaire', 'mon-theme'),
        'section'  => 'mon_theme_colors',
        'settings' => 'mon_theme_secondary_color',
    )));

    $wp_customize->add_setting('mon_theme_background_color', array(
        'default' => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mon_theme_background_color_control', array(
        'label'    => __('Couleur de Fond Mode Sombre (Default)', 'mon-theme'),
        'section'  => 'mon_theme_colors',
        'settings' => 'mon_theme_background_color',
    )));

    $wp_customize->add_setting('mon_theme_text_color', array(
        'default' => '#eeeeee',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mon_theme_text_color_control', array(
        'label'    => __('Couleur du Texte  Mode Sombre (Default)', 'mon-theme'),
        'section'  => 'mon_theme_colors',
        'settings' => 'mon_theme_text_color',
    )));

    $wp_customize->add_setting('mon_theme_background2_color', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mon_theme_background2_color_control', array(
        'label'    => __('Couleur de Fond Secondaire', 'mon-theme'),
        'section'  => 'mon_theme_colors',
        'settings' => 'mon_theme_background2_color',
    )));

    $wp_customize->add_setting('mon_theme_background_color_light', array(
        'default' => '#dddddd',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mon_theme_background_color_light_control', array(
        'label'    => __('Couleur de Fond Mode Clair', 'mon-theme'),
        'section'  => 'mon_theme_colors',
        'settings' => 'mon_theme_background_color_light',
    )));

    $wp_customize->add_setting('mon_theme_text_color_light', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mon_theme_text_color_light_control', array(
        'label'    => __('Couleur du Texte Mode Clair', 'mon-theme'),
        'section'  => 'mon_theme_colors',
        'settings' => 'mon_theme_text_color_light',
    )));
}
add_action('customize_register', 'mon_theme_customizer');

function mon_theme_customize_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo get_theme_mod('mon_theme_primary_color', '#37a8ff'); ?>;
            --secondary-color: <?php echo get_theme_mod('mon_theme_secondary_color', '#87bfff'); ?>;
            --background-color: <?php echo get_theme_mod('mon_theme_background_color', '#222222'); ?>;
            --background2-color: <?php echo get_theme_mod('mon_theme_background2_color', '#333333'); ?>;
            --text-color: <?php echo get_theme_mod('mon_theme_text_color', '#eeeeee'); ?>;

            --background-color-light: <?php echo get_theme_mod('mon_theme_background_color_light', '#dddddd'); ?>;
            --text-color-light: <?php echo get_theme_mod('mon_theme_text_color_light', '#333333'); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'mon_theme_customize_css');


function add_theme_color_toggle_script() {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const themeToggle = document.getElementById("themeColorToggle");
            const body = document.body;
            const savedTheme = localStorage.getItem("themeColor") || "dark";
            
            if (savedTheme === "light") {
                body.classList.add("light-theme");
                themeToggle.textContent = "Mode Sombre";
            }

            themeToggle.addEventListener("click", () => {
                body.classList.toggle("light-theme");
                const isLight = body.classList.contains("light-theme");
                themeToggle.textContent = isLight ? "Mode Sombre" : "Mode Clair";
                localStorage.setItem("themeColor", isLight ? "light" : "dark");
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'add_theme_color_toggle_script');
?>
