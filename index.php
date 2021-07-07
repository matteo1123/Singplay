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
				the_post();?>
				<div class="post-item">
					<h2 class="headline headline--medium headline--post-title"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
					<div class="meta-box">
						<p> posted by Brad </p>
					</div>
					<div class="generic content">
						<?php echo the_excerpt() ?>
						<a class="btn" href=<?php echo the_permalink(); ?>Continue Reading &raquo;</a></p>
					</div>
				</div>
			<?php } ?>
		</main>
	</div>

	
	<?php get_sidebar(); ?>

<?php
get_footer();
