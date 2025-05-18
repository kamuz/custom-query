<?php get_header( 'parts/header.php' ); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
		<?php
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'tax_query'      => array(
				'relation' => 'AND',
				array(
					'taxonomy'         => 'category',
					'field'            => 'slug',
					'terms'            => array( 'reviews' ),
					'include_children' => true,
					'operator'         => 'IN',
				),
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'slug',
					'terms'    => array( 'Laravel' ),
					'operator' => 'IN',
				),
			),
		);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<div>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<div class="post">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php echo ! empty( get_field( 'views' ) ) ? '(' . esc_html( get_field( 'views' ) . ')' ) : '(0)'; ?> <?php echo ! empty( get_field( 'source' ) ) ? esc_html( ' — ' . get_field( 'source' ) ) : ''; ?> </h3>
						<div class="categories">
							<strong>Categories:</strong>
							<?php the_category(); ?>
						</div>
						<div class="tags">
							<strong>Tags:</strong>
							<?php the_tags( '', ', ' ); ?>
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