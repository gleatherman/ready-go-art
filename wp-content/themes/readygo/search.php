<?php get_header(); ?>
​
	<div class="cc-content">
​
		<div class="container-fluid">
​
			<div class="content">
​	
	<?php if (have_posts()) : ?>
	<?php get_search_form(); ?>
	
		<p class="pagetitle">Search Results for "<?php echo $s ?>"</p>
		
		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
            
​
				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<?php
				// Support for "Search Excerpt" plugin
				// http://fucoder.com/code/search-excerpt/
				if ( function_exists('the_excerpt') && is_search() ) {
					the_excerpt();
				} ?>
				
				<p class="small">
					
					
					
				</p>
				
			</div>
			
			<hr>
		<?php endwhile; ?>
​
		<div class="pagination">
			
			<?php previous_posts_link('Previous') ?>
			<?php next_posts_link('Next') ?>
		</div>
​
	<?php else : ?>
​
		<h2 class="center">No posts found. Try a different search?</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
​
	<?php endif; ?>
​
		</div> <!-- /content -->
	</div> <!-- /maincontent-->
	</div> <!-- /page -->
​
<?php get_footer(); ?>