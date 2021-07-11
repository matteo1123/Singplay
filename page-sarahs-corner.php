<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'post',
	'meta_key'		=> 'premium',
	'meta_value'	=> 'true'
);
$the_query = new WP_Query($args);
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<h3>Thank you for subscribing</h3>
				<?php if( $the_query->have_posts() ): ?>
					<?php while ( $the_query->have_posts() ) {
					$the_query->the_post();?>
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
				<?php }; ?>
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
