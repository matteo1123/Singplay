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
$results = $wpdb->get_results('SELECT * FROM wp_posts INNER JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id WHERE wp_posts.post_type = "coursesowned" AND wp_posts.post_status = "publish" order by wp_posts.ID');
if(count($results) > 0) {
    $courses_owned = array();
	$arr = array();
	echo "<pre>";
    foreach($results as $result) {
        if($arr['id'] != $result->id) {
            array_push($courses_owned, $arr);
			$arr = array();
        }
		if($result->meta_key == "course_id") {
           $arr['course_id'] = get_field('course_id', $result->post_id);
           $arr['id'] = $result->ID;
        }
        if($result->meta_key == "user_id") {
			print_r($result);
            $arr['user_id'] = $result->meta_value;
        }
    }
	array_push($courses_owned, $arr);
    foreach($courses_owned as $course) {
        if($course['user_id'] == get_current_user_id()) {
			$owned = $course['course_id'];
        }
    }
}
print_r($courses_owned);
echo "</pre>";
get_header(); 

?>

<div>
	<div style="width:100vw; margin:10px;" class="row">
		<div style="height:fit-content; padding-right:30px; padding-left:50px;" class="col-xl-4 btn btn-light">
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
									<p> posted by <?php echo the_author() ?></p>
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
									<p> posted by <?php echo the_author() ?></p>
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
									<p> posted by <?php echo the_author() ?></p>
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
?>
