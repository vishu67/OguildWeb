<?php

/**
 * The template for displaying all elementor template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div class="mg-main-blog nxsingle-post">
        <main id="primary" class="site-main">
            <?php
            while (have_posts()) :
                the_post();
                the_content();

            endwhile; // End of the loop.
            ?>
        </main>
    </div>
    <?php wp_footer(); ?>

</body>

</html>