<?php get_header(); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo('name') ?></h1>
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 1
		);
		$query = new WP_Query($args);
		?>
		<?php if($query->have_posts()): ?>
				<?php while($query->have_posts()) : $query->the_post(); ?>
					<div class="featured">
						<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</div>
					<?php $current_post = $post->ID; ?>
				<?php endwhile;?>
		<?php else: ?>
			<?php echo __('Pages not found yet, sorry!', 'simple') ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 5,
			'post__not_in' => array($current_post)
		);
		$query = new WP_Query($args);
		?>
		<?php if($query->have_posts()): ?>
			<ul>
				<?php while($query->have_posts()) : $query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
				<?php endwhile;?>
			</ul>
		<?php else: ?>
			<?php echo __('Pages not found yet, sorry!', 'simple') ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
<?php get_footer(); ?>