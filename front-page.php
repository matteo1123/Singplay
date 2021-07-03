<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php
	define('__ROOT__', dirname(dirname(__FILE__)));
	require_once(__ROOT__.'\TWENTYSEVENTEEN\stripe\stripe-php\init.php');
	\Stripe\Stripe::setApiKey('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');

	$session = \Stripe\Checkout\Session::create([
	'payment_method_types' => ['card'],
	'line_items' => [[
		'price_data' => [
		'currency' => 'usd',
		'product_data' => [
			'name' => 'T-shirt',
		],
		'unit_amount' => 2000,
		],
		'quantity' => 1,
	]],
	'mode' => 'payment',
	'success_url' => 'http://localhost:4242/success',
	'cancel_url' => 'http://example.com/cancel',
	]);
	?>


    <title>Buy cool new product</title>
    <script src="https://js.stripe.com/v3/"></script>
    <button id="checkout-button">Checkout</button>
    <script>
      var stripe = Stripe('pk_live_51J8aHSL0JmGeLUnZrw3QAoCBBvwdEn1SE2PQYA3EetCL009aShmh7nb5x9uBlTiv2jznyFakBvMRIM9jbngYu8wB0009bMePPj');
      const btn = document.getElementById("checkout-button")
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        stripe.redirectToCheckout({
          sessionId: "<?php echo $session->id; ?>"
        });
      });
    </script>

		<?php
		// Show the selected front page content.
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else :
			get_template_part( 'template-parts/post/content', 'none' );
		endif;
		?>

		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== twentyseventeen_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filters the number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param int $num_sections Number of front page sections.
			 */
			$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );
			global $twentyseventeencounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$twentyseventeencounter = $i;
				twentyseventeen_front_page_section( null, $i );
			}

	endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
