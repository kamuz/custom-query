<?php get_header( 'parts/header.php' ); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
		<?php
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => 1,
		);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<div class="featured">
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php $current_post = $post->ID; ?>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<?php echo esc_html__( 'Pages not found yet, sorry!', 'simple' ); ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		<?php
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 4,
			'post__not_in'   => array( $current_post ),

		);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<ul>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		<?php else : ?>
			<?php echo esc_html__( 'Pages not found yet, sorry!', 'simple' ); ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php get_footer(); ?>