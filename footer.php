<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div style="display:flex; justify-content:flex-end;" class="wrap">
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) :
					?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
								)
							);
						?>
					</nav><!-- .social-navigation -->
					<?php
				endif;

				get_template_part( 'template-parts/footer/site', 'info' );
				?>
				<?php
				if(is_user_logged_in()) {
					$user_meta=get_userdata(get_current_user_id());
					$user_roles=$user_meta->roles;
					?>
					<a href=<?php echo wp_logout_url(); ?> class="btn btn-outline-secondary">Logout</a>
					</div>
					<div style="display:flex; justify-content:center;">
						<?php if(!in_array("administrator", $user_roles)) {
							$user_id = get_current_user_id();
							if(!get_field('end_date', "user_$user_id")) {
								if(!in_array("student", $user_roles)) {
									echo "<a id='cancelSubscription' class='btn btn-outline-secondary'>cancel subscription</a>";
								} else {
									echo "<a href='/sarahs-corner/' class='btn btn-outline-secondary'>Premium Content</a>";
								}
							}
						}?>	
					</div>
				<?php } else { ?>
					<a href=<?php echo wp_registration_url(); ?> class="btn btn-small btn-secondary">Sign Up</a>
					<a href=<?php echo wp_login_url(); ?> class=" btn btn-outline-secondary">Login</a>
				<?php } ?>
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
