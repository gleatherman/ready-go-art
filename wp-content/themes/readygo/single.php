<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="hero">
		<img class="hero-image" src="<?php the_post_thumbnail_url() ?>" alt="" />
	</div>
	<div class="section">
		<div class="section-inner">
			<h1><span><?php the_title(); ?></span></h1>
			<?php the_content(); ?>
		</div>
	</div>
	<?php get_template_part( 'partials/second-opinion' ); ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
