<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
	<div class="section">
		<div class="section-inner">
			<div class="posts">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="post">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-image', array( 'class' => 'post-image' ) ); ?></a>
						<div class="post-details">
							<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="post-meta"><?php the_time( get_option( 'date_format' ) ); ?></p>
							<div class="post-description"><?php the_excerpt(); ?></div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<?php get_template_part( 'partials/second-opinion' ); ?>
<?php endif; ?>
<?php get_footer(); ?>
