<?php get_header(); ?>
	<div class="section section-blue">
		<div class="section-inner">
			<form id="filter-form">
				<select name="categories">
					<option disabled selected>Great For</option>
					<?php $categories = get_terms( 'tool_category', array( 'hide_empty' => false ) ); ?>
					<?php foreach ( $categories as $category ) : ?>
						<option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
					<?php endforeach; ?>
				</select>
				<select name="locations">
					<option disabled selected>Available In</option>
					<?php $locations = get_terms( 'tool_location', array( 'hide_empty' => false ) ); ?>
					<?php foreach ( $locations as $location ) : ?>
						<option value="<?php echo $location->term_id; ?>"><?php echo $location->name; ?></option>
					<?php endforeach; ?>
				</select>
				<select name="options">
					<option disabled selected>Options</option>
					<?php $options = get_terms( 'tool_option', array( 'hide_empty' => false ) ); ?>
					<?php foreach ( $options as $option ) : ?>
						<option value="<?php echo $option->term_id; ?>"><?php echo $option->name; ?></option>
					<?php endforeach; ?>
				</select>
				<select name="engagements">
					<option disabled selected>Size &amp; Specs</option>
					<?php $engagements = get_terms( 'tool_engagement', array( 'hide_empty' => false ) ); ?>
					<?php foreach ( $engagements as $engagement ) : ?>
						<option value="<?php echo $engagement->term_id; ?>"><?php echo $engagement->name; ?></option>
					<?php endforeach; ?>
				</select>
				<a class="btn btn-shadow" href="/tools/">Clear All</a>
			</form>
		</div>
	</div>

	<div class="section">
		<div class="section-inner">
			<div id="filter-set" class="grid">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php $location = get_field( 'artist_location' ); ?>
					<a href="<?php the_permalink(); ?>" class="grid-item filter-item"
					       data-categories="<?php echo get_custom_taxonomy_list( get_the_ID(), 'tool_category' ) ?>"
					       data-locations="<?php echo get_custom_taxonomy_list( get_the_ID(), 'tool_location' ) ?>"
					       data-options="<?php echo get_custom_taxonomy_list( get_the_ID(), 'tool_option' ) ?>"
					       data-engagements="<?php echo get_custom_taxonomy_list( get_the_ID(), 'tool_engagement' ) ?>">
						<?php the_post_thumbnail( 'thumbnail' ); ?>
						<div class="grid-item-title">
							<span><?php the_title(); ?></span>
							<span class="grid-item-extra"><br/><?php echo $location; ?></span>
						</div>
					</a>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>

<?php get_template_part( 'partials/second-opinion' ); ?>
<?php get_footer(); ?>