<?php get_header(); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo('name') ?></h1>
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => array('programming'),
					'include_children' => true,
					'operator' => 'IN'
				),
				array(
					'taxonomy' => 'post_tag',
					'field' => 'slug',
					'terms' => array('javascript', 'wordpress'),
					'operator' => 'IN'
				)
			)
		);
		$query = new WP_Query($args);
		?>
		<?php if($query->have_posts()): ?>
				<?php while($query->have_posts()) : $query->the_post(); ?>
					<div class="post">
						<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> <?php if(!empty(get_field('views'))) { echo '('. get_field('views') . ')'; } ?><?php if(!empty(get_field('source'))) { echo ' &mdash; ' . get_field('source'); } ?></h2>
						<div class="flex">
							<div class="categories">
								<strong>Categories:</strong>
								<?php the_category() ?>
							</div>
							<div class="tags">
								<?php the_tags() ?>
							</div>
						</div>
					</div>
				<?php endwhile;?>
		<?php else: ?>
			<?php echo __('Pages not found yet, sorry!', 'simple') ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
<?php get_footer(); ?>