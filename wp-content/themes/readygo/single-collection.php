<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="hero">
		<img class="hero-image" src="<?php the_post_thumbnail_url() ?>" alt="" />
		<div class="hero-copy">
			<p><span>Collection</span></p>
			<h1><span><?php the_title(); ?></span></h1>
		</div>
	</div>

	<div class="section">
		<div class="section-inner">
			<?php the_content(); ?>
		</div>
	</div>

	<?php $tools = get_field( 'tools' ); ?>
	<?php if ( $tools ) : ?>
		<h2 class="lines"><span>In The Collection</span></h2>
		<div class="section">
			<div class="section-inner">
				<div class="grid">
					<?php foreach( $tools as $post ) : ?>
						<?php setup_postdata( $post ); ?>
						<?php $location = get_field( 'artist_location' ); ?>
						<a href="<?php the_permalink(); ?>" class="grid-item">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
							<div class="grid-item-title">
								<span><?php the_title(); ?></span>
								<span class="grid-item-extra"><br/><?php echo $location; ?></span>
							</div>
						</a>
					<?php endforeach; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php get_template_part( 'partials/second-opinion' ); ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
