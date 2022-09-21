<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magic Elementor
 */
$magic_elementor_blog_container = get_theme_mod('magic_elementor_blog_container', 'mg-wrapper');
$magic_elementor_blog_layout = get_theme_mod('magic_elementor_blog_layout', 'rightside');
$magic_elementor_blog_style = get_theme_mod('magic_elementor_blog_style', 'list');

if (is_active_sidebar('sidebar-1') && $magic_elementor_blog_layout != 'fullwidth') {
	$magic_elementor_blog_column = 'mg-grid-9';
} else {
	$magic_elementor_blog_column = 'mg-grid-12';
}
get_header();
?>

<div class="<?php echo esc_attr($magic_elementor_blog_container); ?> mg-main-blog">
	<div class="mg-flex">
		<?php if (is_active_sidebar('sidebar-1') && $magic_elementor_blog_layout == 'leftside') : ?>
			<div class="mg-grid-3">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($magic_elementor_blog_column); ?>">
			<main id="primary" class="site-main">

				<?php if (have_posts()) : ?>

					<header class="page-header archive-header">
						<?php
						the_archive_title('<h1 class="page-title">', '</h1>');
						the_archive_description('<div class="archive-description">', '</div>');
						?>
					</header><!-- .page-header -->

					<?php

					/* Start the Loop */
					while (have_posts()) :
						the_post();

						/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
						get_template_part('template-parts/content', get_post_type());

					endwhile;

					?>

				<?php
					the_posts_pagination();

				else :

					get_template_part('template-parts/content', 'none');

				endif;
				?>

			</main><!-- #main -->
		</div>
		<?php if (is_active_sidebar('sidebar-1') && $magic_elementor_blog_layout == 'rightside') : ?>
			<div class="mg-grid-3">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
