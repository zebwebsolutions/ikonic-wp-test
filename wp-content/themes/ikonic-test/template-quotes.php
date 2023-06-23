<?php
/**
 * Template Name: Kanye West Quotes
 */

// Get the header
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        $quotes = get_kanye_quotes(5);

        if (!empty($quotes)) {
            echo '<ul class="quotes">';
            foreach ($quotes as $quote) {
                echo '<li>' . esc_html($quote) . '</li>';
            }
            echo '</ul>';
        } else {
            echo 'Unable to fetch quotes. Please try again later.';
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// Get the footer
get_footer();
