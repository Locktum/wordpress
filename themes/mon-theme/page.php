<?php get_header(); ?>

<div class="container">
    <div class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="page-title">
                <h1><?php the_title(); ?></h1>
            </div>
            <?php
            $child_pages = new WP_Query([
                'post_type' => 'page',
                'post_parent' => get_the_ID(),
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ]);

            if ($child_pages->have_posts()) :
            ?>
                <div class="child-pages-navigation">
                    <h2>Pages liées</h2>
                    <ul>
                        <?php while ($child_pages->have_posts()) : $child_pages->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; wp_reset_postdata(); ?>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
