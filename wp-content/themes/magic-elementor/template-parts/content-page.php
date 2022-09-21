<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magic Elementor
 */
$magic_elementor_page_header = get_theme_mod('magic_elementor_page_header', 'show');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ($magic_elementor_page_header == 'show' || ($magic_elementor_page_header == 'hide-home' && !is_front_page())) : ?>
		<?php if (!in_array('elementor-default', get_body_class())) : ?>
			<header class="entry-header page-header">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			</header><!-- .entry-header -->

		<?php endif; ?>
	<?php endif; ?>
	<?php magic_elementor_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'magic-elementor'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->