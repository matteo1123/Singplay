<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */
$add_classes = get_field( 'add_classes' );
$post = $add_classes[0];
$watchedVideos = new WP_Query(array(
    'post_type' => 'watches',
    'meta_query' => array(
        array(
            'key' => 'user_id',
            'compare' => '=',
            'value' => get_current_user_id()
        )
        )
    ));
    echo '<pre>';
    print_r($watchedVideos);
    echo '</pre>';
    
get_header(); ?>


<div >
	<div class="container">
		<div  class="row">
        <div class="col-9" style="border:solid black 2px; height: 1000px;">
        <iframe style="width:100%; height:100%;" name="class_window" src="<?php echo the_permalink() ?>" noscroll>
        </iframe>
        </div>
        <div class="col-3">
            <ol>
                <?php foreach( $add_classes as $post ):?>
                    <div style="padding: 45px 45px 45px 45px; margin:0;"  class="btn btn-outline-secondary row">
                        <a class="col-10" target="class_window" href="<?php echo the_permalink() ?>">
                            <li title="view <?php echo get_the_title()?>" ><?php echo get_the_title() ?><a class="col-2" title="Mark lesson completed" style="padding:15px; margin:0;" >X</a></li>
                        </a>
                    </div>
                <?php endforeach; ?> 
            </ol>
        </div>
		</div><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->