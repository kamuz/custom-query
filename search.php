<?php
/**
 * Template name: Custom Search
 */
get_header(); ?>
	<div class="container">
		<p>&laquo; <a href="/">Back Home</a></p>
		<h1 class="title">Search for: <?php echo (!empty($search)) ? $search : 'NULL' ?></h1>
		<?php
		if(!empty($_GET['type'])){
			$type = $_GET['type'];
		} else {
			$type = array('post', 'movie');
		}
		if(!empty($_GET['search'])){
			$search = $_GET['search'];
		} else {
			$search = '';
		}
		$args = array(
			'post_type' => $type,
			'posts_per_page' => -1,
			's' => $search,
			'sentence' => true,
		);
		$query = new WP_Query($args);
		?>
		<?php if($query->have_posts()): ?>
			<?php while($query->have_posts()) : $query->the_post(); ?>
				<div class="post">
					<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
					<?php
					if(get_post_type() == 'post'){
						echo 'Type: Post';
					} elseif(get_post_type() == 'movie') {
						echo 'Type: Movie';
					}
					?>
				</div>
			<?php endwhile;?>
		<?php else: ?>
			<?php echo __('Sorry, but product not found yet!', 'simple') ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
<?php get_footer(); ?>