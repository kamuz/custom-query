<?php get_header( 'parts/header.php' ); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
		<?php
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'relation' => 'OR',
					array(
						'key'     => 'size',
						'value'   => 'm',
						'type'    => 'CHAR',
						'compare' => '=',
					),
					array(
						'key'     => 'color',
						'value'   => 'blue',
						'type'    => 'CHAR',
						'compare' => '=',
					),
				),
				array(
					'key'     => 'price',
					'value'   => array( 50, 200 ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				),
			),
		);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<div>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<div class="product">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="flex">
							<div class="price">
								<strong>Price:</strong>
								<div>$<?php the_field( 'price' ); ?></div>
							</div>
							<div class="size-color">
								<div class="size">
									<strong>Size:</strong>
									<?php the_field( 'size' ); ?>
								</div>
								<div class="color">
									<strong>Color:</strong>
									<?php the_field( 'color' ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<?php echo esc_html__( 'Pages not found yet, sorry!', 'simple' ); ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php get_footer(); ?>