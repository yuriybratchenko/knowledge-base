<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Kava
 */

get_header();

	$done = false;

	if ( function_exists( 'jet_theme_core' ) ) {
		$done = jet_theme_core()->locations->do_location( 'kb_404' );
	}

	if ( ! $done ) {
		do_action( 'kava-theme/site/site-content-before', '404' ); ?>

		<div <?php kava_content_class() ?>>
			<div class="row">

				<?php do_action( 'kava-theme/site/primary-before', '404' ); ?>

				<div id="primary" class="col-xs-12">

					<?php do_action( 'kava-theme/site/main-before', '404' ); ?>

					<main id="main" class="site-main">

						<section class="error-404 not-found px-56 mb-56">
                            <h1 class="page-title h3"><?php esc_html_e( 'Oops... page not found', 'knowledge-base' ); ?></h1>
                            <p class="mt-8 mb-36"><?php esc_html_e( 'We are sorry but it might have moved. But the good news is we get a notification about this problem and will try to fix it as soon as possible.', 'kava' ); ?></p>
                            <a class="btn btn-custom btn-outline btn-sm btn-color-inverse btn-jetpopup" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to Help Center', 'knowledge-base' ); ?></a>
                        </section>

					</main><!-- #main -->

					<?php do_action( 'kava-theme/site/main-after', '404' ); ?>

				</div><!-- #primary -->

				<?php do_action( 'kava-theme/site/primary-after', '404' ); ?>

			</div>
		</div>

		<?php do_action( 'kava-theme/site/site-content-after', '404' );
	}

get_footer();
