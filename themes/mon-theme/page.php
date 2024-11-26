<?php get_header(); ?>

<div class="container">
    <div class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="page-title">
                <h1><?php the_title(); ?></h1>
            </div>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
