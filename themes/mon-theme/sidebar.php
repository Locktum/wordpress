<aside class="sidebar">
<div class="page-title">
        <h2>Technologie</h2>
    </div>
    <div class="page-content">
        <ul>
            <?php
            $sidebar_query = new WP_Query([
                'category_name' => 'technologie',
                'posts_per_page' => 10,
            ]);
            if ($sidebar_query->have_posts()):
                while ($sidebar_query->have_posts()): $sidebar_query->the_post(); ?>
                    <li class="sidebar-article">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                        <a href="<?php the_permalink(); ?>" class="sidebar-link">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        </a>
                    </li>
                <?php endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </ul>
    </div>
</aside>