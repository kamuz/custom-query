<?php get_header( 'parts/header.php' ); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
		<?php
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$args  = array(
			'post_type'      => array( 'post', 'movie' ),
			'paged'          => $paged,
			'posts_per_page' => 2,
		);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<div>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<div class="post">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php
						if ( get_post_type() == 'post' ) {
							echo 'Type: Post';
						} elseif ( get_post_type() == 'movie' ) {
							echo 'Type: Movie';
						}
						?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php
			$args = array(
				'type'      => 'list', // ul with li tags instead of tag a.
				'total'     => $query->max_num_pages, // total amount of pages.
				'current'   => ( ( $query->query_vars['paged'] ) ? $query->query_vars['paged'] : 1 ), // current page number.
				'show_all'  => false, // set to true if you want to show all pages at once.
				'mid_size'  => 2, // how much page numbers to show on the each side of the current page.
				'end_size'  => 2, // how much page numbers to show at the beginning and at the end of the list.
				'prev_next' => true, // if you set this to false, the previous and the next post links will be removed.
				'prev_text' => '«', // «
				'next_text' => '»', // »
			);
			?>
			<div class="pagination"><?php echo paginate_links( $args ); ?></div>
		<?php else : ?>
			<?php echo esc_html__( 'Pages not found yet, sorry!', 'simple' ); ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php get_footer(); ?>