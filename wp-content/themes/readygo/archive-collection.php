<?php get_header(); ?>
    <div class="section section-blue">
        <div class="section-inner">
            <form id="filter-form">
                <select name="locations">
                    <option value="">Any Location</option>
                    <?php $locations = get_terms( 'collection_location', array( 'hide_empty' => false ) ); ?>
                    <?php foreach ( $locations as $location ) : ?>
                        <option value="<?php echo $location->term_id; ?>"><?php echo $location->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <a class="btn btn-shadow" href="/collections/">Clear All</a>
            </form>
        </div>
    </div>

    <div class="section">
        <div class="section-inner" id="filter-set">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="collection filter-item"
                   data-locations="<?php echo get_custom_taxonomy_list( get_the_ID(), 'collection_location' ) ?>"
                   style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>);">
                    <div class="collection-info">
                        <div class="collection-title"><span><?php the_title(); ?></span></div>
                        <div class="collection-description"><span><?php the_field( 'description' ); ?></span></div>
                        <div class="collection-meta"><span><?php echo count(get_field( 'tools' )); ?> tools in <?php the_field( 'location' ); ?></span></div>
                    </div>
                </a>
            <?php endwhile; endif; ?>
        </div>
    </div>

    <?php get_template_part('partials/second-opinion'); ?>
<?php get_footer(); ?>