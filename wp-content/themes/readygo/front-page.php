<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="hero">
        <img class="hero-image" src="<?php the_field('hero_image'); ?>" alt="" />
        <div class="hero-copy">
            <h1><span><?php the_field('hero_title'); ?></span></h1>
            <p><span><?php the_field('hero_copy'); ?></span></p>
        </div>
    </div>
    <div class="section section-blue section-center">
        <div class="section-inner">
            <form action="/tools/" method="get">
                I'm interested in
                <select name="c">
                    <?php $categories = get_field( 'tool_categories' ); ?>
                    <?php foreach ( $categories as $category ) : ?>
                        <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach; ?>
                </select>
                with art &amp; interaction.
                <input class="btn-alt btn-shadow" type="submit" value="find tools"/>
            </form>
        </div>
    </div>

    <?php $featured_tools = get_field('featured_tools'); ?>
    <?php if ($featured_tools): ?>
        <h2 class="lines"><span>Featured Tools</span></h2>
        <div class="section">
            <div class="section-inner">
                <div class="grid">
                    <?php foreach ($featured_tools as $post): ?>
                        <?php setup_postdata($post); ?>
                        <a href="<?php the_permalink(); ?>" class="grid-item">
                            <?php the_post_thumbnail('thumbnail'); ?>
                            <div class="grid-item-title">
                                <span><?php the_title(); ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <div class="text-center">
                    <a class="btn btn-shadow" href="/tools/">browse tools</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php $featured_collections = get_field('featured_collections'); ?>
    <?php if ($featured_collections): ?>
        <h2 class="lines"><span>Featured Collections</span></h2>
        <div class="section">
            <div class="section-inner">
                <?php foreach ($featured_collections as $post): ?>
                    <?php setup_postdata($post); ?>
                    <a href="<?php the_permalink(); ?>" class="collection" style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>);">
                        <div class="collection-info">
                            <div class="collection-title"><span><?php the_title(); ?></span></div>
                            <div class="collection-description"><span><?php the_field( 'description' ); ?></span></div>
                            <div class="collection-meta"><span><?php echo count(get_field( 'tools' )); ?> tools in <?php the_field( 'location' ); ?></span></div>
                        </div>
                    </a>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="text-center">
                <a class="btn btn-shadow" href="/collections/">view all collections</a>
            </div>
        </div>
    <?php endif; ?>

    <?php $featured_categories = get_field('featured_categories'); ?>
    <?php if ($featured_categories): ?>
        <?php foreach ($featured_categories as $category): ?>
            <h2 class="lines"><span>Great For <?php echo $category->name; ?></span></h2>
            <div class="section">
                <div class="grid">
                    <?php $args = array('cat' => $category->term_id, 'post_type' => 'tool', 'orderby' => 'rand', 'posts_per_page' => 3); ?>
                    <?php $category_posts = new WP_Query($args); ?>
                    <?php if ($category_posts->have_posts()) : ?>
                        <?php while ($category_posts->have_posts()) : $category_posts->the_post(); ?>
                            <a href="<?php the_permalink(); ?>" class="grid-item">
                                <?php the_post_thumbnail('thumbnail'); ?>
                                <div class="grid-item-title">
                                    <span><?php the_title(); ?></span>
                                </div>
                            </a>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (have_rows('faqs')): ?>
        <?php $faqCounter = 1; ?>
        <h2 class="lines"><span>FAQs</span></h2>
        <div class="section">
            <div class="section-inner">
                <?php while (have_rows('faqs')) : the_row(); ?>
                    <?php if ($faqCounter % 2 != 0): ?>
                        <div class="row">
                    <?php endif; ?>
                    <div class="col col-6 col-margin">
                        <h2><?php the_sub_field('question'); ?></h2>
                        <p><?php the_sub_field('answer'); ?></p>
                        <p><a href="<?php the_sub_field('link'); ?>">Keep Reading</a></p>
                    </div>
                    <?php if ($faqCounter % 2 == 0): ?>
                        </div>
                    <?php endif; ?>
                    <?php $faqCounter++; ?>
                <?php endwhile; ?>
                <div class="text-center">
                    <a class="btn btn-shadow" href="/help/">more help &amp; FAQs</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php get_template_part('partials/second-opinion'); ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>