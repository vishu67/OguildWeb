<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magic Elementor
 */
$magic_elementor_categories = get_the_category();
if ($magic_elementor_categories) {
	$magic_elementor_category = $magic_elementor_categories[mt_rand(0, count($magic_elementor_categories) - 1)];
} else {
	$magic_elementor_category = '';
}
if (has_post_thumbnail()) {
	$magic_elementor_imgclass = 'nx-has-img';
} else {
	$magic_elementor_imgclass = 'nx-no-img';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('nx-list-item'); ?>>
	<div class="single-nx-list-item <?php echo esc_attr($magic_elementor_imgclass); ?>">
		<?php if (has_post_thumbnail()) : ?>
			<div class="nx-single-list-img">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('medium_large'); ?>
				</a>
			</div>
		<?php endif; ?>
		<div class="nx-single-list-details">
			<?php if ($magic_elementor_category) : ?>
				<a href="<?php echo esc_url(get_category_link($magic_elementor_category)); ?>" class="nx-list-categories"><?php echo esc_html($magic_elementor_category->name); ?></a>
			<?php endif; ?>
			<?php the_title('<h2 class="nx-list-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
			<?php the_excerpt(); ?>
			<a class="magic-elementor-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE', 'magic-elementor'); ?></a>

		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->