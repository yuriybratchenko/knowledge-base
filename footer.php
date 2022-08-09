<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kava
 */
?>

	</div>

    <?php
    $cp = is_singular('jetplugins');
    if ( $cp ) {
        include get_theme_file_path('tmp/need-help.php');
    }
    ?>

	<footer id="colophon">
		<?php kava_theme()->do_location( 'footer', 'template-parts/footer' ); ?>
	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
