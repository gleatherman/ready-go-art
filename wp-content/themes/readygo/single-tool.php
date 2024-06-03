<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php $subpage = get_query_var( 'subpage' ); ?>
	<div class="section">
		<div class="section-inner">
			<h1><?php the_title(); ?></h1>
			<?php if ( $subpage ): ?>
				<?php if ( $subpage == 'request' ): ?>
					<h2 class="text-dark">Request a Booking</h2>
					<div class="row">
						<div class="col col-8">
						<?php echo do_shortcode( '[ninja_form id=5]' ); ?>
						</div>
						<div class="col col-4"></div>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<?php $posttags = get_the_tags(); ?>
				<?php if ( $posttags && ! is_wp_error( $posttags ) ): ?>
					<?php $tags = array(); ?>
					<?php foreach ( $posttags as $posttag ) {
						$tags[] = $posttag->name;
					} ?>
					<p class="text-small">
						<span class="icon-price-tag text-red"></span>
						<?php echo implode( ', ', $tags ); ?>
					</p>
				<?php endif; ?>
			<div class="row">
				<div class="col col-8">
					<?php the_post_thumbnail( 'large' ); ?>
					<p class="intro"><?php the_field( 'intro' ); ?></p>
					<hr class="lines" />
					<div class="tabs">
						<div class="tabs-top">
							<a href="#" class="tab tab-active" data-tab-target="1">overview</a>
							<a href="#" class="tab" data-tab-target="2">options &amp; pricing</a>
							<a href="#" class="tab" data-tab-target="3">size &amp; specifications</a>
						</div>

						<div class="tab-content" data-tab="1" style="display: block;">
							<?php the_field( 'overview_copy' ); ?>
						</div>
						<div class="tab-content" data-tab="2">
							<?php the_field( 'options_and_pricing_copy' ); ?>
						</div>
						<div class="tab-content" data-tab="3">
							<?php the_field( 'size_and_specifications_copy' ); ?>
						</div>
					</div>
				</div>
				<div class="col col-4 sidebar">
					<div class="sidebar-copy"><?php the_field( 'sidebar_copy' ); ?></div>
					<div class="sidebar-contact">
						<a class="btn btn-shadow" href="<?php echo $_SERVER['REQUEST_URI'] ?>request/">request a
							booking</a>
						<!-- <a href="http://www.addthis.com/bookmark.php" class="addthis_button" ><b>share</b></a> -->
					</div>
					<div class="artist">
						<?php echo get_avatar( get_field( 'artist_email_address' ), 40 ); ?>
						<p><b><?php the_field( 'artist_name' ); ?></b><br/>based
							in <?php the_field( 'artist_location' ); ?></p>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( $subpage != 'request' ): ?>
		<h2 class="lines"><span>About the Artist</span></h2>
		<div class="section">
			<div class="section-inner">
				<div class="text-center text-narrow">
					<div class="artist">
						<?php echo get_avatar( get_field( 'artist_email_address' ), 40 ); ?>
						<p><b><?php the_field( 'artist_name' ); ?></b></p>
						<p>based in <?php the_field( 'artist_location' ); ?></p>
						<p><?php the_field( 'artist_bio' ); ?></p>
					</div>
					<br/>
					<h4 class="text-dark">Have a question about the tool?</h4>
					<p><a class="btn btn-shadow" href="<?php echo $_SERVER['REQUEST_URI'] ?>request/">contact the
							artist</a>
					</p>
				</div>
			</div>
		</div>

		<?php
		$terms    = get_the_terms( $post->ID, 'tool_category', 'string' );
		$term_ids = wp_list_pluck( $terms, 'term_id' );
		$query    = new WP_Query( array(
			'post_type'           => 'tool',
			'tax_query'           => array(
				array(
					'taxonomy' => 'tool_category',
					'field'    => 'id',
					'terms'    => $term_ids,
					'operator' => 'IN'
				)
			),
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => 1,
			'orderby'             => 'rand',
			'post__not_in'        => array( $post->ID )
		) );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<h2 class="lines"><span>Related Tools</span></h2>
			<div class="section">
				<div class="section-inner">
					<div class="grid">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php $location = get_field( 'artist_location' ); ?>
							<a href="<?php the_permalink(); ?>" class="grid-item">
								<?php the_post_thumbnail( 'thumbnail' ); ?>
								<div class="grid-item-title">
									<span><?php the_title(); ?></span>
									<span class="grid-item-extra"><br/><?php echo $location; ?></span>
								</div>
							</a>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		<?php endif;
		wp_reset_query(); ?>
		<?php get_template_part( 'partials/second-opinion' ); ?>
	<?php endif; ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
