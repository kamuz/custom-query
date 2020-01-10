<?php get_header(); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo('name') ?></h1>
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'relation' => 'OR',
					array(
						'key' => 'size',
						'value' => 'm',
						'type' => 'CHAR',
						'compare' => '='
					),
					array(
						'key' => 'color',
						'value' => 'green',
						'type' => 'CHAR',
						'compare' => '='
					)
				),
				array(
					'key' => 'price',
					'value' => array(10, 20),
					'type' => 'NUMERIC',
					'compare' => 'BETWEEN'
				)
			)
		);
		$query = new WP_Query($args);
		?>
		<?php if($query->have_posts()): ?>
			<?php while($query->have_posts()) : $query->the_post(); ?>
				<div class="product">
					<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					<div class="flex">
						<div class="price">
							<strong>Price:</strong>
							<div>$<?php the_field('price') ?></div>
						</div>
						<div class="size-color">
							<div>
								<strong>Size:</strong>
								<?php the_field('size') ?>
							</div>
							<div>
								<strong>Color:</strong>
								<?php the_field('color') ?>
							</div>
						</div>
						<div class="color">

						</div>
					</div>
				</div>
				<hr>
			<?php endwhile;?>
		<?php else: ?>
			<?php echo __('Pages not found yet, sorry!', 'simple') ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
<?php get_footer(); ?>