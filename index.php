<?php get_header(); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo('name') ?></h1>
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 10,
			'meta_key' => 'views',
			'meta_compare' => '=',
			'meta_value' => 1000,
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		);
		$query = new WP_Query($args);
		?>
		<?php if($query->have_posts()): ?>
			<ul>
				<?php while($query->have_posts()) : $query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> (<?php if(!empty(get_field('views'))) { echo get_field('views'); } ?>)</li>
				<?php endwhile;?>
			</ul>
		<?php else: ?>
			<?php echo __('Pages not found yet, sorry!', 'simple') ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
<?php get_footer(); ?>