<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="section">
        <div class="section-inner">
            <h1><?php the_title(); ?></h1>
            <div class="row">
                <div class="col col-8">
                    <?php the_content(); ?>
                </div>
                <div class="col col-4">
                    Sidebar Content
                </div>
            </div>
        </div>
    </div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>