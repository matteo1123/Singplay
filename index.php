<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">
			<?php while(have_posts()) {
				the_post();
				if(get_field('premium') == "false") {?>
					<a href="<?php echo the_permalink(); ?>">
						<div style="min-height:300px; display:flex; margin-bottom:20px;" class="btn btn-dark btn-block container-fluid row">
							<div class="col-8">
									<h2 class="text-left"><?php echo the_title(); ?></h2>
								</div>
							<div class="col-4">
								<?php if(get_the_post_thumbnail_url()){ ?>
									<img style="height:200px; width:300px;" src="<?php echo get_the_post_thumbnail_url()?>"/>
								<?Php } else { ?>
									<img style="height:200px; width:300px;" src="/wp-content/uploads/2021/07/music-images-9-scaled.jpg">
								<?php }; ?>
							</div>
							<p class="course-excerpts"><?php echo get_the_excerpt() ?></p>
						</div>
					</a>
				<?php }
				} ?>
		</main>
	</div>

	
	<?php get_sidebar(); ?>

<?php
get_footer();
