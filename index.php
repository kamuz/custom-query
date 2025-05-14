<?php get_header( 'parts/header.php' ); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
		<?php
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => 100,
			'meta_key'       => 'views',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC',
		);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<div>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php echo ! empty( get_field( 'views' ) ) ? '(' . esc_html( get_field( 'views' ) . ')' ) : '(0)'; ?> <?php echo ! empty( get_field( 'source' ) ) ? esc_html( ' — ' . get_field( 'source' ) ) : ''; ?> </li>
					<?php $current_post = $post->ID; ?>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<?php echo esc_html__( 'Pages not found yet, sorry!', 'simple' ); ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php get_footer(); ?>