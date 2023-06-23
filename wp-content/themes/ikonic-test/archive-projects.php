<?php
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <header class="page-header">
            <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
        </header>

        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = array(
            'post_type'      => 'projects',
            'posts_per_page' => 6, // Display only 6 projects
            'paged'          => $paged,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>

            <div class="project-archive">

                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                        </header>

                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>

            </div>

            <?php
            // Restore original post data
            wp_reset_postdata();

            // Display pagination
            echo '<div class="pagination">';
            the_posts_pagination(array(
                'prev_text'          => __('Previous'),
                'next_text'          => __('Next'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page') . ' </span>',
            ));
            echo '</div>';

        else : ?>
            <p><?php _e('No projects found.'); ?></p>
        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
