<?php get_header(); ?>

<div class="container">
    <div class="main-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="page-title">
                <h1><?php the_title(); ?></h1>
            </div>
            <div class="page-content">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>

                <div class="post-content">
                    <?php the_content(); ?>
                </div>

                <div class="post-meta">
                    <p>Publié le <strong><?php the_date(); ?></strong> par <strong><?php the_author(); ?></strong></p>
                    <p>Catégories : <?php the_category(', '); ?></p>
                    <p><?php the_tags('Tags : ', ', ', ''); ?></p>
                </div>

                <div class="post-navigation">
                    <?php if (get_previous_post()) : ?>
                        <div class="prev-post">
                            <strong>Article précédent :</strong>
                            <?php previous_post_link('%link', '%title'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (get_next_post()) : ?>
                        <div class="next-post">
                            <strong>Article suivant :</strong>
                            <?php next_post_link('%link', '%title'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="related-posts">
                <h2>Articles connexes</h2>
                <div class="related-posts-container">
                    <?php
                    $categories = wp_get_post_categories(get_the_ID());
                    $related_query = new WP_Query([
                        'category__in' => $categories,
                        'post__not_in' => [get_the_ID()],
                        'posts_per_page' => 3,
                    ]);
                    
                    if ($related_query->have_posts()) :
                        while ($related_query->have_posts()) : $related_query->the_post(); ?>
                            <div class="related-article">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium'); ?>
                                    <?php endif; ?>
                                    <h3><?php the_title(); ?></h3>
                                </a>
                            </div>
                        <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
