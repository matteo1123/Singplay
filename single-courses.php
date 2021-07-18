<?php
/**
 * The template for displaying courses for sale as well as courses already purchased
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */
if(!is_user_logged_in()) {
    wp_redirect("/");
} else {
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
 <?php 
    $ID = get_the_ID();

    $new_owned = get_posts(array(
		'numberposts'	=> -1,
		'post_type'		=> 'coursesowned',
		'meta_key'		=> 'user_id',
		'meta_value'	=> get_current_user_id()
	));
	if($new_owned) {
		$owned = get_field('course_id', $new_owned[0]->ID);
	}
    if(!is_array($owned) || !in_array($ID, $owned)) {
        get_template_part( 'template-parts/page/purchase');
    } else {
?>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div><!-- .wrap -->
                <a href=<?php echo wp_logout_url(); ?> class="login btn btn-outline-secondary">Logout</a>
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->
	<div >
		<div >

<?php
$add_classes = get_field( 'add_classes' );
$post = $add_classes[0];
global $wpdb;
$results = $wpdb->get_results('SELECT * FROM wp_posts INNER JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id WHERE wp_posts.post_type = "watches" AND wp_posts.post_status = "publish"  ');
if(count($results) > 0) {
    $watched = array();
    $user_results = array();
    $user_watched = array();
    $arr = array();
    foreach($results as $result) {
        if($result->meta_key == "class_id") {
           $arr['class_id'] = $result->meta_value;
           $arr['id'] = $result->ID;
        }
        if($result->meta_key == "user_id") {
            $arr['user_id'] = $result->meta_value;
         }
        if($arr['user_id'] && $arr['class_id']) {
            array_push($watched, $arr);
            $arr = array();
        }
    }
    foreach($watched as $watch) {
        if($watch['user_id'] == get_current_user_id()) {
            array_push($user_results, $watch);
            array_push($user_watched, $watch['class_id']);
        }
    }
}
?>
<script type="text/javascript">
    let watches = <?php echo json_encode($user_watched); ?>;
    let user_results = <?php echo json_encode($user_results); ?>;
</script>

<div >
	<div class="container" style="margin:0;">
		<div style="width:100vw;" class="row">
        <div class="col-9" style="height: 1000px; padding:0;">
        <div style="width:100%; height:100%; border:0;" oncontextmenu="return false;" class="class_window">
        </div>
        </div>
        <div style="padding:0; margin:0;" class="col-3">
            <ol>
                <?php if($add_classes) { ?>
                    <?php foreach( $add_classes as $post ):?>
                    <?php if(is_array($user_watched)): ?>
                        <?php if(in_array(get_the_ID(),$user_watched)): ?>

                        <div
                            title="view <?php echo get_the_title()?>"
                            data-post=<?php echo basename(get_permalink()) ?>
                            data-id=<?php echo get_the_ID() ?>
                            style="padding: 45px 45px 45px 30px; margin:0;"
                            class="class-link btn btn-outline-light btn-block row"
                        >
                            <li ><?php echo get_the_title() ?></li>
                        </div>
                        <?php else: ?>
                            <div
                                data-post=<?php echo basename(get_permalink()) ?>
                                data-id=<?php echo get_the_ID() ?>
                                style="padding: 45px 45px 45px 30px; margin:0;"
                                class="class-link btn btn-block btn-outline-dark row"
                                title="view <?php echo get_the_title()?> again (already completed lesson)"
                            >
                                <li><?php echo get_the_title() ?></li>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div
                            title="view <?php echo get_the_title()?>"
                            data-id=<?php echo get_the_ID() ?>
                            data-post=<?php echo basename(get_permalink()) ?>
                            style="padding: 45px 45px 45px 30px; margin:0;"
                            class="class-link btn btn-outline-dark btn-block row"
                        >
                            <li ><?php echo get_the_title() ?></li>
                        </div>
                    <?php endif; ?>
                <?php endforeach;
                } ?>
            </ol>
        </div>
		</div><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<?php }
} ?>
