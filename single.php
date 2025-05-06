<?php get_header(); ?>
	<div class="container">
		<p>&laquo; <a href="<?php echo esc_html( get_post_type_archive_link( 'post' ) ); ?>">Back to the Posts</a></p>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php the_title( '<h1>', '</h1>' ); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>