<?php get_header( 'parts/header.php' ); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
		<ul>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			<?php endif; ?>
		</ul>
	</div>
<?php get_footer(); ?>