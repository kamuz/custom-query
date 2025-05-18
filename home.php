<?php get_header(); ?>
	<?php
	if ( ! empty( $_GET['minprice'] ) ) {
		$minprice = $_GET['minprice'];
	} else {
		$minprice = 0;
	}
	if ( ! empty( $_GET['maxprice'] ) ) {
		$maxprice = $_GET['maxprice'];
	} else {
		$maxprice = 9999;
	}
	if ( ! empty( $_GET['size'] ) ) {
		$size = $_GET['size'];
	} else {
		$size = array( 's', 'm', 'l', 'xl' );
	}
	if ( ! empty( $_GET['color'] ) ) {
		$color = $_GET['color'];
	} else {
		$color = array( 'red', 'green', 'blue', 'white', 'dark' );
	}
	?>
	<div class="container">
		<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
		<div class="filter">
			<form action="/">
				<label for="minprice">Min Price:</label>
				<input type="number" id="minprice" name="minprice" value="<?php echo $minprice; ?>">
				<label for="minprice">Max Price:</label>
				<input type="number" id="maxprice" name="maxprice" value="<?php echo $maxprice; ?>">
				<label for="size">Size:</label>
				<select name="size" id="size">
					<option value="">Any</option>
					<option value="s" <?php echo ( $size == 's' ) ? 'selected' : ''; ?>>S</option>
					<option value="m" <?php echo ( $size == 'm' ) ? 'selected' : ''; ?>>M</option>
					<option value="l" <?php echo ( $size == 'l' ) ? 'selected' : ''; ?>>L</option>
					<option value="xl" <?php echo ( $size == 'xl' ) ? 'selected' : ''; ?>>XL</option>
				</select>
				<label for="color">Color:</label>
				<select name="color" id="color">
					<option value="">Any</option>
					<option value="red" <?php echo ( $color == 'red' ) ? 'selected' : ''; ?>>Red</option>
					<option value="blue" <?php echo ( $color == 'blue' ) ? 'selected' : ''; ?>>Blue</option>
					<option value="green" <?php echo ( $color == 'green' ) ? 'selected' : ''; ?>>Green</option>
					<option value="white" <?php echo ( $color == 'white' ) ? 'selected' : ''; ?>>White</option>
					<option value="dark" <?php echo ( $color == 'dark' ) ? 'selected' : ''; ?>>Dark</option>
				</select>
				<input type="submit" value="Filter">
			</form>
		</div>
		<?php
		$args  = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'meta_query'     => array(
				'relation' => 'AND',
				array(
					'key'     => 'price',
					'type'    => 'NUMERIC',
					'value'   => array( $minprice, $maxprice ),
					'compare' => 'BETWEEN',
				),
				array(
					'key'     => 'size',
					'value'   => $size,
					'compare' => 'IN',
				),
				array(
					'key'     => 'color',
					'value'   => $color,
					'compare' => 'IN',
				),
			),
		);
		$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ) : ?>
				<?php $query->the_post(); ?>
				<div class="product">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="flex">
						<div class="price">
							<strong>Price:</strong>
							$<?php the_field( 'price' ); ?>
						</div>
						<div>
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
		<?php else : ?>
			<?php echo esc_html__( 'Sorry, but product not found yet!', 'simple' ); ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php get_footer(); ?>