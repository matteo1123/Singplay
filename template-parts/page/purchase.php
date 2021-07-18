<script>
    purchase = true;
    let user_id = <?php echo get_current_user_id(); ?>;
    let course_id = <?php echo get_the_id(); ?>;
    let unit_amount = <?php echo the_field('list_price', get_the_ID());?>;
    let image = "<?php echo the_post_thumbnail_url(); ?>"
    if(!image) image = window.location.origin + '/wp-content/uploads/2021/07/cropped-music-images-6-scaled-4.jpg' ;
    let title = "<?php echo the_title(); ?>";
</script>
