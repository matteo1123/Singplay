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
if(!is_user_logged_in()) {
    wp_redirect("/");
} else {
    $video = get_field('video');
    ?>
    <style>
    .wp-block-video{
        left:0;
        top:0;
        transform:scale(.8);
    }
    </style>
    <h2><?php echo the_title(); ?></h2>
    <?php if ($video): ?>
    <figure style="width:100%; padding:0; margin:0;" ><video controls id="classVideo" style="width:100%" src="<?php echo $video['url'] ?>"></video></figure>
    <button data-id=<?php echo get_the_ID() ?> data-user=<?php echo get_current_user_id()  ?> class="watched"> Mark class completed</button>
    <?php endif; ?>

    <?php
    echo Get_the_content();
    if(comments_open()){
        comments_template();
    }
}
?>