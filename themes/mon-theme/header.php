<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="container">
            <h1 class="site-logo">
                <a href="<?php echo home_url(); ?>">
                    <?php the_custom_logo(); ?>
                </a>
            </h1>
            <p><?php bloginfo('description'); ?></p>
            <nav class="main-navigation">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main_menu',
                        'container' => false,
                        'menu_class' => 'main-menu',
                    ) );
                ?>
            </nav>
            <div class="theme-color-toggle">
                <button id="themeColorToggle">Mode Clair</button>
            </div>
        </div>
    </header>
