<?php
/**
 * The template for displaying courses for sale as well as courses already purchased
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */
if(!is_user_logged_in()) {
    wp_redirect("/");
} else {
	$new_owned = get_posts(array(
		'numberposts'	=> -1,
		'post_type'		=> 'coursesowned',
		'meta_key'		=> 'user_id',
		'meta_value'	=> get_current_user_id()
	));
	if($new_owned) {
		$owned = get_field('course_id', $new_owned[0]->ID);
	}
	get_header();
	?>

	<div>
		<div style="width:100vw; margin:10px;" class="row">
			<div style="height:fit-content; padding-right:30px; padding-left:50px;" class="col-xl-4 btn btn-dark">
			<div class="col-xl-12">
				<h2 class="text-left">My Courses</h2>
			</div>
			<div id="myCourses">
				<p class="text-center">-You do not currently own any courses-</p>
			</div>
			</div>
			<div class="col-xl-8">

			<?php
			if ( have_posts() ) {?>
				<?php while(have_posts()) {
					the_post();?>
					<?php if (is_array($owned)) { ?>
						<?php if(in_array(get_the_ID(), $owned)){ ?>
							<a class="myOwnedCourses" ;" style="display:none;" href="<?php echo the_permalink(); ?>">
								<div style="min-height:300px; display:flex; margin-bottom:20px;" class="btn btn-outline-info btn-block container-fluid row">
									<div class="col-xl-12">
											<h2 class="text-left"><?php echo the_title(); ?></h2>
										
										<p class="font-weight-bold text-left">You own this course!</p>
									</div>
									<div class="col-xl-4">
										<?php if(get_the_post_thumbnail_url()){ ?>
											<img style="height:150px; width:150px;"" src="<?php echo get_the_post_thumbnail_url()?>"/>
										<?Php } else { ?>
											<img style="height:150px; width:150px;"src="/wp-content/uploads/2021/07/music-images-9-scaled.jpg">
										<?php } ?>
									</div>
									<p class="course-excerpts"><?php echo get_the_excerpt() ?></p>
								</div>
							</a>
						<?php } else { ?>
							<a href="<?php echo the_permalink(); ?>">
								<div style="min-height:300px; display:flex; margin-bottom:20px;" class="btn btn-dark btn-block container-fluid row">
									<div class="col-xl-8">
											<h2 class="text-left"><?php echo the_title(); ?></h2>
										
										<p class="font-weight-bold text-left">Buy now for: <?php echo the_field('list_price', get_the_ID());?></p>
									</div>
									<div class="col-xl-4">
										<?php if(get_the_post_thumbnail_url()){ ?>
											<img style="height:150px; width:150px;"" src="<?php echo get_the_post_thumbnail_url()?>"/>
										<?Php } else { ?>
											<img style="height:150px; width:150px;"src="/wp-content/uploads/2021/07/music-images-9-scaled.jpg">
										<?php }; ?>
									</div>
									<p class="course-excerpts"><?php echo get_the_excerpt() ?></p>
								</div>
							</a>
						<?php }; ?>
					<?php } else { ?>
							<a href="<?php echo the_permalink(); ?>">
								<div style="min-height:300px; display:flex; margin-bottom:20px;" class="btn btn-dark btn-block container-fluid row">
									<div class="col-xl-8">
											<h2 class="text-left"><?php echo the_title(); ?></h2>
										
										<p class="font-weight-bold text-left">Buy now for: <?php echo the_field('list_price', get_the_ID());?></p>
									</div>
									<div class="col-xl-4">
										<?php if(get_the_post_thumbnail_url()){ ?>
											<img style="height:150px; width:150px;"" src="<?php echo get_the_post_thumbnail_url()?>"/>
										<?Php } else { ?>
											<img style="height:150px; width:150px;"src="/wp-content/uploads/2021/07/music-images-9-scaled.jpg">
										<?php }; ?>
									</div>
									<p class="course-excerpts"><?php echo get_the_excerpt() ?></p>
								</div>
							</a>
					<?php }; ?>
				<?php }; ?>
			<?php }; ?>

			</div>
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .wrap -->

	<?php
	get_footer();
}
?>
