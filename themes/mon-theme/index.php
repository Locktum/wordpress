<?php get_header(); ?>

<div class="container">
    <div class="main-content">
        <div class="page-title">
            <h1>Actualités & À la Une</h1>
        </div>
        <div class="page-content">
            <h2>À la Une</h2>
            <?php
                $featured_query = new WP_Query([
                    'category_name' => 'à-la-une',
                    'posts_per_page' => 2
                ]);
                if ($featured_query->have_posts()):
            ?>
                <div class="featured-articles-container">
                    <?php
                    while ($featured_query->have_posts()): $featured_query->the_post(); ?>
                        <div class="article featured featured-size">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                            <div class="overlay">
                                <h2><?php the_title(); ?></h2>
                                <a href="<?php the_permalink(); ?>" class="read-more-link">Voir l'article</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php
                endif;
                wp_reset_postdata();
            ?>
        </div>
        <div class="page-content">
            <h2>Actualités</h2>
            <?php
                $news_query = new WP_Query([
                    'category__not_in' => [get_cat_ID('à-la-une')],
                    'posts_per_page' => -1,
                ]);

                if ($news_query->have_posts()):
                    while ($news_query->have_posts()): $news_query->the_post(); ?>
                        <div class="article article-size">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                            <div class="overlay">
                                <h2><?php the_title(); ?></h2>
                                <p><?php the_excerpt(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="read-more-link">Lire la suite de l'article</a>
                            </div>
                        </div>
                    <?php endwhile;
                endif;

                wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
