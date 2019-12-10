<?php get_header(); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo('name') ?></h1>
		<ul>
		<?php if(have_posts()): while(have_posts()) : the_post(); ?>
			<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
		<?php endwhile; endif; ?>
		</ul>
	</div>
<?php get_footer(); ?>